
<table width="795" align="center" bgcolor="pink">
    <tr align="center">
        <td colspan="6"><h2>View All Categories Here</h2></td>
    </tr>
    <tr align="center" bgcolor="skyblue">
        <th>Category ID</th>
        <th>parentCategoryID</th>
		<th>Category Name</th>
		<th>Edit</th>
		<th>Delete</th>
    </tr>
    <?php
    include("includes/connection.php");
    $get_cat = "select * from category";
    $run_cat = mysqli_query($con, $get_cat);
    $i = 0;
    while($row_cat=mysqli_fetch_array($run_cat)){
        $categoryID = $row_cat['categoryID'];
        $categoryParentID = $row_cat['parentcategoryID'];
        $categoryName = $row_cat['categoryName'];
        $i++;
    ?>
    <tr align = "center">
        <td><?php echo $i; ?></td>
        <td><?php echo $categoryName; ?></td>
        <td><a href="index.php?edit_cat=<?php echo $cat_id; ?>">Edit</a></td>
        <td><a href="delete_cat.php?delete_cat=<?php echo $cat_id;?>">Delete</a></td>
    </tr>
    <?php } ?>
</table>