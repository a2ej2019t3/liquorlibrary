<form action="" method="post" style="padding:80px;">
    <tr align="right">
    <td><b>Brand ID:</b></td>
    <td><input type="text" name="brandID" required/></td>
    <td><b>Brnad Name:</b></td>
    <td><input type="text" name="brnadName" required/></td>
    </tr>
   <tr align="center"
    <input type="submit" name="add_brand" value="Add Brand" />
</tr>
</form>
<?php
    include("includes/connection.php");
    if(isset($_POST['add_brand'])){
        $brandID = $_POST['brandID'];
        $braandName = $_POST['brandName'];
        $insert_brand = "insert into brand (brandID, brandName) values ('$brnadID', '$brandName')";
        $run_brand = mysqli_query($con, $insert_brand);
        if($run_brand){
            echo "<script>alert('New Brand has been inserted!')</script>";
            echo "<script>window.open('index.php?view_brands','_self')</script>";
           }
    }
?>
