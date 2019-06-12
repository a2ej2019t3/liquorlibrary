<!DOCTYPE>
<?php
//include("includes/db.php");
?>
<html>
    <head>
        <title>Inserting Product</title>
       
    </head>
    <body bgcolor="skyblue">
        <form action="insert_product.php" method="post" enctype="multipart/form-data">
            <table align="center" width="795" border="2" bgcolor="#187eae">
                <tr align="center"><!--colspan属性规定单元格可横跨的列数。b规定粗体文本-->
                    <td colspan="7"><h2>Insert New Post Here</h2></td>
                </tr>
                <tr>
                    <td align="right"><b>Product ID:</b></td>
                    <td><input type="text" name="productID" size="60" required="required" /></td>
                </tr>
                <tr>
                    <td align="right"><b>Product Category:</b></td>
                    <td>
                        <select name="categoryID" required="required">
                            <option>Select a Category</option>
                            <?php
                                global $con;
                                $get_cats = "select * from category";
                                $run_cats = mysqli_query($con, $get_cats);
                                while($row_cats = mysqli_fetch_array($run_cats)){
                                    $categoryID = $row_cats['categoryID'];
                                    $categoryName = $row_cats['categoryName'];
                                    echo "<option value='$categoryID'>$categoryName</option>";
                                } 
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td align="right"><b>Product Brand:</b></td>
                    <td>
                        <select name="brandID" required="required">
                            <option>Select a Brand</option>
                            <?php
                                $get_brand = "select * from brand";
                                $run_brand = mysqli_query($con, $get_brand);
                                while($row_brand = mysqli_fetch_array($run_brand)){
                                    $brandID = $row_brand['brandID'];
                                    $brandName = $row_brand['brandName'];
                                    echo "<option value='$brandID'>$brandName</option>";
                                } 
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td align="right"><b>Product Image:</b></td>
                    <td><input type="file" name="img" /></td>
                </tr>
                <tr>
                    <td align="right"><b>Product Price:</b></td>
                    <td><input type="text" name="price" required="required"/></td>
                </tr>
                <tr>
                    <td align="right"><b>ProductName:</b></td>
                    <td><textarea name="productName" cols="20" rows="10" required="required"></textarea></td>
                </tr>
                <tr>
                    <td align="right"><b>Product Discount:</b></td>
                    <td><input type="text" name="discountprice" size="50" required="required"/></td>
                </tr>
                <tr align="center">
                    <td colspan="7"><input type="submit" name="insert_post" value="Insert Now"/></td>
                </tr>
            </table>
        </form>
    
    
    </body>
    
</html>
<?php
    if(isset($_POST['insert_post'])){
        //getting the text data from the fields
        $productID = $_POST['productID'];
        $categoryID = $_POST['categoryID'];
        $brandID = $_POST['brandID'];
        $price = $_POST['price'];
        $productName = $_POST['productName'];
        $discountprice = $_POST['discountprice'];
        
        //getting the image from the field
		$product_image = $_FILES["product_image"]["img"];
		
        $filepath ="images/".$images;
		
		move_uploaded_file($img,$filepath);
        
        $insert_product = "insert into product (productID,productName,price,discountprice,img,categoryID,brandID) values ('$productID','$productName',$price,'$discountprice','$img','$categoryID','$brandID')";
        
        $insert_pro = mysqli_query($con, $insert_product);
        if($insert_pro){
            echo "<script>alert('product has been inserted')</script>";
            echo "<script>window.open('index.php?insert_product','_self')</script>";
        }
    }
?>