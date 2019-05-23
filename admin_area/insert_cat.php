<form action="" method="post" style="padding:80px;">
   
   <tr align="right">
   <td> <b>CategoryID:</b>
    <input type="text" name="categoryID" required/>
    </td>
    </tr>
    <td>
    <b>parent CategoryID:</b>
    <input type="text" name="parentcategoryID" required/>
   </td>
   <td>
    <b>Category Name:</b>
    <input type="text" name="categoryName" required/>
    <input type="submit" name="add_cat" value="Add Category" />
</td>
</tr>
</form>
<?php
    include("includes/connection.php");
    if(isset($_POST['add_cat'])){
        $categoryID= $_POST['categoryID'];
        $parentcategoryID= $_POST['parentcategoryID'];
        $categoryName=$_POST['categoryName']
        $insert_cat = "insert into category (categoryID,parentcategoryID,categoryName) values ('$categoryID','$parentcategoryID','$categoryName')";
        $run_cat = mysqli_query($con, $insert_cat);
        if($run_cat){
            echo "<script>alert('New Category has been inserted!')</script>";
            echo "<script>window.open('index.php?view_cats','_self')</script>";
           }
    }
?>
