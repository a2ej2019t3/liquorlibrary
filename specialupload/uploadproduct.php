<?php
    // $ref = $_SESSION['ref'];
   
    if( isset($_POST['submit'])) {
        session_start();
        include ('../connection.php');
        $_SESSION['postId'] = $_POST['postid'];
        $searchcontent = $_SESSION['postId'];
    
        $searchItem_sql = "SELECT p.productID, p.img, p.productName, p.discountprice, p.price,p.categoryID, b.brandName, c.categoryName,c.categoryID FROM product AS p, brand AS b, category AS c WHERE p.brandID=b.brandID and p.categoryID=c.categoryID and  p.productID = $searchcontent";
        $searchItem_res = mysqli_query($connection, $searchItem_sql);
        

          if ($searchItem_res != "") {
            $searchItem_arr = mysqli_fetch_all($searchItem_res);
            $resultcount=count($searchItem_arr);
            $productName = $searchItem_arr[0][2];
            $price = $searchItem_arr[0][3];
            $dealinfo = $_POST['dealinfo'];
            $imgsrc = $searchItem_arr[0][1];
            $postID=$searchcontent;
        } else {
            alert("result empty");
        }
        //   print_r($_POST['submit']);

        
    }
//post product to DB here
    include ('../connection.php');


    $newpost_sql = "INSERT INTO `specials`(`specialName`, `specialType`, `specialPrice`, `specialInfo`, `specialImg`,`productID`) VALUES ('$productName',2,'$price','$dealinfo','$imgsrc',$postID)";

    if ($connection->query($newpost_sql) === TRUE) {
        // echo "inserted successfully".'<br>';window.location = '../specials.php';
        echo "<script>alert('Successfully Updated');window.location.href='javascript:history.back(-1);' </script>";
       
    } else {
        echo "Error: " . $newpost_sql . "<br>" . $connection->error.'<br>';
    }
    echo "<br>$productName - $price -$imgsrc - $dealinfo".'<br>';
?> 
    
           
      
  
    
      
    
