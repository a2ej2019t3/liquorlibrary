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
            $sql = "(SELECT product.productID, product.productName, product.price, product.discountprice, product.img, brand.brandName, category.categoryName, category.categoryID, COALESCE((100-product.discountprice) * product.price / 100, 0) AS discountRate FROM product 
            LEFT JOIN brand ON product.brandID = brand.brandID
            LEFT JOIN category ON product.categoryID = category.categoryID) AS allproduct ";
            
            return $sql;
        }

        public function getOrderInfo ($cartID, $itemID, $type = 'NUM') {
            if ($cartID === null && $itemID !== null) {
                if (is_array($itemID)) {
                        $keyword = 'orderitems.itemID';
                        $cons = $this->prepareSql($keyword, $itemID);
                }
            } else {
                $cons = 'orderitems.orderID = '.$cartID;
            }
            $sql = "SELECT *,product.img, COALESCE((100-product.discountprice) * product.price / 100, 0) AS discountRate FROM product 
            LEFT JOIN brand ON product.brandID = brand.brandID
            LEFT JOIN category ON product.categoryID = category.categoryID 
            LEFT JOIN orderitems ON product.productID = orderitems.itemID 
            LEFT JOIN orders ON orderitems.orderID = orders.orderID WHERE $cons";
            $res = $this->connection->query($sql);
            $data = array();
            if ($res) {
                $arr = $res->fetch_all(MYSQLI_ASSOC);
                if (isset($type) && $type == 'ASSOC') {
                    foreach ($arr as $key => $value) {
                        $data[$value['productID']] =  $value;
                    }
                } else if (isset($type) && $type == 'NUM') {
                    $data = $arr;
                }
                return $data;
            } else {
                trigger_error($this->connection->error);
                trigger_error($sql);
            }
        }

        private function prepareSql ($key, $value) {
            $res = '';
            if (is_array($value)) {
                foreach ($value as $k => $v) {
                    $res .= "$key = $v OR ";
                }
                $res = trim($res, "OR ");
            } else {
                $res .= "$key = $value AND ";
            }
            return $res;
        }

        //select * from a table
        private function selectSql($table, $consArr) {
            $constrant = "";
            $sql = "SELECT * FROM $table WHERE ";
            if ($consArr != null) {
                foreach ($consArr as $key => $value) {
                    if ($key == 'spec') {
                        $constrant .= "$value AND ";
                    } else if ($key == 'LIMIT') {
                        $constrant = trim($constrant, "AND ");
                        $constrant .= " LIMIT ".$value;
                    } else if ($key == 'ORDER BY') {
                        $constrant = trim($constrant, "AND ");
                        $constrant .= "$key $value";
                    } else {
                        $constrant .= $this->prepareSql($key, $value);
                    }
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
        public function getCartItemsInfo($cartID, $consArr) {
            if ($cartID !== null) {
                $sql = "";
                $allProduct = $this->getProductInfo();
                $allProduct .= "RIGHT JOIN orderitems ON allproduct.productID = orderitems.itemID ";
                if ($consArr !== null) {
                    $constrant = array('orderID' => $cartID);
                    foreach ($consArr as $key => $value) {
                        $constrant = array_merge($constrant, $consArr);
                    }
                } else if ($consArr === null || $consArr == '') {
                    $constrant = array('orderID' => $cartID);
                }
                // return $constrant;
                $sql .= $this->selectSql($allProduct, $constrant);
                $res = $this->connection->query($sql);
                if (!$res) {
                    trigger_error('Invalid query: '. $sql);
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
                        trigger_error($sql);
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
                    return false;
                } else {
                    if ($res->num_rows > 0) {
                        while ($arr = $res->fetch_assoc()) {
                            $row = $arr;
                            $data[$row['itemID']] = $row;
                        }
                        $_SESSION['cartItemNum'] = count($data);
                        return $data;
                    } else {
                        return null;
                    }
                }
            }
        }

        // common select
        public function select ($table, $consArr) {
            if ($table !== null && $consArr !== null) {
                $sql = $this->selectSql($table, $consArr);
                $res = $this->connection->query($sql);
                if (!$res) {
                    trigger_error('Invalid query: ' . $this->connection->error);
                    trigger_error('query: ' . $sql);
                    return $sql;
                } else {
                    if ($res->num_rows > 0) {
                        $data = $res->fetch_all(MYSQLI_ASSOC);
                        return $data;
                    }
                }
            } else {
                return false;
            }
            // return $sql;
        }

        // insert into orderitems
        public function insertItems ($table, $valArr) {
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
                $sql .= $cols.") VALUES (".$vals.") ";
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

        public function updateCart ($itemID, $orderID, $quantity) {
            if ($itemID != null && $orderID != null && $quantity != null) {
                $newvals = "`quantity` = $quantity ";
                $cons = "`orderID` = ".$orderID;
                $sql = "UPDATE `orderitems` SET $newvals WHERE $cons";
                $res = $this->connection->query($sql);
                if ($res) {
                    return true;
                } else {
                    trigger_error('Invalid query: ' . $this->connection->error);
                    return false;
                }
            }
        }

        public function updateDB ($table, $valArr, $consArr) {
            if ($table !== null && $consArr !== null && $valArr !== null) {
                $newVals = "";
                $cons = "";
                foreach ($valArr as $key => $value) {
                    $newVals .= $key."='".$value."',";
                }
                $newVals = trim($newVals, ",");
                foreach ($consArr as $key => $value) {
                    $cons .= $key."='".$value."' AND ";
                }
                $cons = trim($cons, "AND ");
                $sql = "UPDATE $table SET $newVals WHERE $cons";
                $res = $this->connection->query($sql);
                if ($res) {
                    return true;
                } else {
                    trigger_error("Query: " . $sql);
                    trigger_error("error: " . $this->connection->error);
                    return false;
                }
            } else {
                trigger_error('missing arguments.');
            }
        }

        public function delete ($table, $consArr) {
            if (isset($table)) {
                $sql = "DELETE FROM $table WHERE ";
                $constrant = '';
                if ($consArr !== null && $consArr != 'ALL') {
                    foreach ($consArr as $key => $value) {
                        if ($key != 'spec') {
                            $constrant .= "$key = $value AND ";
                        } else {
                            $constrant .= "$value AND ";
                        }
                    }
                    $sql .= $constrant;
                    $sql = rtrim($sql, "AND ");
                } else if ($consArr == 'ALL') {
                    $sql = rtrim($sql, "WHERE ");
                } else {
                    return false;
                }
                // return $sql;
                $res = $this->connection->query($sql);
                if ($res) {
                    return true;
                    // trigger_error($sql);
                } else {
                    trigger_error('Invalid query: ' . $this->connection->error);
                    trigger_error('Invalid query: ' . $sql);
                    return false;
                }
            }
        }
    }