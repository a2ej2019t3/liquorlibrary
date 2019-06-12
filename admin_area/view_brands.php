
<table width="795" align="center" bgcolor="pink">
    <tr align="center">
        <td colspan="6"><h2>View All Brands Here</h2></td>
    </tr>
    <tr align="center" bgcolor="skyblue">
        <th>Brand ID</th>
		<th>Brand Name</th>
        <th>Image</th>
		<th>Edit</th>
		<th>Delete</th>
    </tr>
    <?php
    include("includes/connection.php");
    $get_brand = "select * from brand";
    $run_brand = mysqli_query($con, $get_brand);
    $i = 0;
    while($row_brand=mysqli_fetch_array($run_brand)){
        $brandid = $row_brand['brandID'];
        $brandName = $row_brand['brandName'];
        $iamge = $row_brand['image'];
        $i++;
    ?>
    <tr align = "center">
        <td><?php echo $i; ?></td>
        <td><?php echo $brandName; ?></td>
        <td><a href="index.php?edit_brand=<?php echo $brandID; ?>">Edit</a></td>
        <td><a href="delete_brand.php?delete_brand=<?php echo $branID;?>">Delete</a></td>
    </tr>
    <?php } ?>
</table>