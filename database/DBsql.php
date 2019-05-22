<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    include 'DBconn.php';

    class sql {

        private $connection;

        public function __construct()
        {
            $this->connection = Conn::getConn();
        }

// unusable functions

        //select all product info
        public function getProductInfo() {
            $sql = "(SELECT product.productID, product.productName, product.price, product.discountprice, product.img, brand.brandName, category.categoryName FROM product 
            LEFT JOIN brand ON product.brandID = brand.brandID
            LEFT JOIN category ON product.categoryID = category.categoryID) AS allproduct ";
            
            return $sql;
        }
        //select * from a table
        private function selectSql($table, $consArr) {
            $constrant = "";
            $sql = "SELECT * FROM $table WHERE ";
            if ($consArr != null) {
                foreach ($consArr as $key => $value) {
                    $constrant .= "$key = $value AND ";
                }
                $sql .= $constrant;
                $sql = trim($sql, "AND ");
            } else {
                $sql = trim($sql, "WHERE ");
            }

            return $sql;
        }

// Useable functions
        //select cart items and info
        public function getCartItemsInfo($cartID) {
            if ($cartID != null) {
                $sql = "";
                $allProduct = $this->getProductInfo();
                $allProduct .= "RIGHT JOIN orderitems ON allproduct.productID = orderitems.itemID ";
                $consArr = array('orderID' => $cartID);
                $sql .= $this->selectSql($allProduct, $consArr);

                $res = $this->connection->query($sql);
                if (!$res) {
                    trigger_error('Invalid query: ' . $this->connection->error);
                    return $sql;
                } else {
                    if ($res->num_rows > 0) {
                        while ($arr = $res->fetch_assoc()) {
                            $row = $arr;
                            $data[$row['productID']] = $row;
                        }
                        $_SESSION['cartItemNum'] = count($data);
                        return $data;
                    } else {
                        return false;
                    }
                }
            }
        }

        // select cart items without info
        public function getCartItems($cartID) {
            if ($cartID != null) {
                $sql = "";
                $consArr = array('orderID' => $cartID);
                $sql .= $this->selectSql('orderitems', $consArr);

                $res = $this->connection->query($sql);
                if (!$res) {
                    trigger_error('Invalid query: ' . $this->connection->error);
                    return $sql;
                } else {
                    if ($res->num_rows > 0) {
                        while ($arr = $res->fetch_assoc()) {
                            $row = $arr;
                            $data[$row['itemID']] = $row;
                        }
                        $_SESSION['cartItemNum'] = count($data);
                        return $data;
                    } else {
                        return false;
                    }
                }
            }
        }

        // common select
        public function select ($table, $consArr) {
            if ($table != null && $consArr != null) {
                $sql = $this->selectSql($table, $consArr);
                $res = $this->connection->query($sql);
                if (!$res) {
                    trigger_error('Invalid query: ' . $this->connection->error);
                    return $sql;
                } else {
                    if ($res->num_rows > 0) {
                        $arr = $res->fetch_assoc();
                        return $arr;
                    }
                }
            } else {
                return false;
            }
        }

        // insert
        public function insert ($table, $consArr, $valArr) {
            if ($table != null && $valArr != null) {
                $sql = "INSERT INTO $table (";
                $cols = "";
                $vals = "";
                $cons = "";
                foreach ($valArr as $key => $value) {
                    $cols .= $key.",";
                    $vals .= "'".$value."', ";
                }
                $cols = trim($cols, ",");
                $vals = trim($vals, ", ");
                $sql .= $cols.") VALUES (".$vals.") WHERE ";
                if ($consArr != null) {
                    foreach ($consArr as $key => $value) {
                        $cons .= $key." = '".$value."' AND ";
                    }
                    $cons = trim($cons, " AND ");
                    $sql .= $cons;
                } else {
                    $sql = trim($sql, " WHERE ");
                }
                $res = $this->connection->query($sql);
                if ($res) {
                    return true;
                } else {
                    trigger_error("error: " . $this->connection->error);
                    return false;
                }
            } else {
                trigger_error("empty parameter");
                return false;
            }
        }

        // insert into orders
        public function insertOrder ($userID) {
            if ($userID != null) {
                $sql = "INSERT INTO `orders`(`buyerID`, `whID`, `date`, `status`) 
                VALUES (?,?,?,?)";
                $sql = $this->connection->prepare($sql);
                $whID = 0;
                $date = date('Y-m-d H:i:s');
                $status = 0;
                $sql->bind_param("ssss", $userID, $whID, $date, $status);
                if ($sql->execute()) {
                    $last_id = $this->connection->insert_id;
                    return $last_id;
                } else {
                    trigger_error('Invalid query: ' . $this->connection->error);
                }
            }
        }

        // insert into cart


        // insert
        // public function insert ($table, $valArr) {
        //     $dbname = 'liquorlibrary';
        //     // get col names of the table
        //     $getColNames_sql = "SELECT `COLUMN_NAME`, `DATA_TYPE`
        //                         FROM `INFORMATION_SCHEMA`.`COLUMNS` 
        //                         WHERE `TABLE_SCHEMA`= $dbname 
        //                             AND `TABLE_NAME`= $table";
        //     if ($colNames_res = $this->connection->query($getColNames_sql)) {
        //         $colNames = $colNames_res->fetch_all();
        //     }
        //     if ($table != null && $valArr != null) {
        //         $colNum = $colNames->num_rows;
        //         $col = "(";
        //         $val = "(";
        //         $dt = "";
        //         for ($i = 0; $i < $colNum; $i++) {
        //             $col .= $colNames[$i]['COLUMN_NAME'].",";
        //             $val .= "?,";
        //             $dt .= "s";
        //             // switch ($colNames[$i]['DATA_TYPE']) {
        //             //     case 'int':
        //             //         $dt .= "i";
        //             //         break;
        //             //     case 'float':
        //             //         $dt .= "d";
        //             //         break;
        //             //     case 'varchar'
        //             //     default:
        //             //         # code...
        //             //         break;
        //             // }
        //         }
        //         $col = trim($col, ",");
        //         $val = trim($val, ",");
        //         $val .= ")";
        //         $col .= ")";
        //     // create sql statement
        //         $sql = "INSERT INTO ? $col VALUES $val";
        //         while ($valArr) {
        //             $vals .= 
        //         }
        //         $sql->bind_param
        //     }
        // }
    }