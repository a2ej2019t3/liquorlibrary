<?php
    session_start();
//upload img to server here
    $target_dir = 'images/';
    if( isset($_POST['submit'])) {
        $total_files = count($_FILES['file']['name']);
        for($x = 0; $x < $total_files; $x++) {
            // Check if file is selected
            if(isset($_FILES['file']['name'][$x])) {

                //used to check if the file is ready to upload
                $readystatus = 1;

            //file info
                //file name on client side
                $client_filename = $_FILES['file']['name'][$x];
                //file name on server side
                $server_filename = $_FILES['file']['tmp_name'][$x];
                //the path that file will be upload to
                $target_file = $target_dir . basename($client_filename);
                //get the file type in lower case
                $filetype = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                //check if file already exists
                if (file_exists($target_file)) {
                    echo "File already exists.".'<br>';
                    $readystatus = 0;
                }else{
                    echo 'exist status: '.$readystatus.'<br>';
                }

                //check if the file is a image
                if ($filetype != 'jpg' && $filetype != 'jpeg' && $filetype != 'png' && $filetype != 'gif') {
                    echo 'Only support .jpg .jpeg .png and .gif'.'<br>';
                    $readystatus = 0;
                }else{
                    echo 'file type status:'.$readystatus.'<br>';
                }

                //check readystatus
                if ($readystatus == 0) {
                    echo '!!!File not uploaded.'.'<br>';
                }
            }
    
        }
    }
//post product to DB here
    include ('../connection.php');

    //check the name of session here
    // $sellerid = 1;
    // $_SESSION['userid'];

    $productName = $_POST['productName'];
    $price = $_POST['price'];
    $dealinfo = $_POST['dealinfo'];
    $imgsrc = basename($_FILES['file']['name'][0]);

    $newpost_sql = "INSERT INTO `specials`(`specialName`, `specialType`, `specialPrice`, `specialInfo`, `specialImg`) VALUES ('$productName',1,'$price','$dealinfo','$imgsrc')";

    if ($connection->query($newpost_sql) === TRUE) {
        // echo "inserted successfully".'<br>';
        echo "<script>alert('Successfully Updated'); window.location = '../specials.php';</script>";
      
    } else {
        echo "Error: " . $newpost_sql . "<br>" . $connection->error.'<br>';
    }
    echo "<br>$productName - $price - $dealinfo".'<br>';
    
?> 
           
      
  
    
      
    
