
<table width="795" align="center" bgcolor="pink">
    <tr align="center">
        <td colspan="6"><h2>View All Products Here</h2></td>
    </tr>
    <tr align="center" bgcolor="skyblue">
        <th>S.N</th>
        <th>Title</th>
        <th>Image</th>
        <th>Price</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
    <?php
    include("includes/db.php");
    $get_pro = "select * from product";
    $run_pro = mysqli_query($con, $get_pro);
    $i = 0;
    while($row_pro=mysqli_fetch_array($run_pro)){
        $productID = $row_pro['productID'];
        $productName = $row_pro['productName'];
        $price = $row_pro['price'];
        $discountprice = $row_pro['discountprice'];
        $img = $row_pro['img'];
        $categoryID = $row_pro['categoryID'];
        $brandID = $row_pro['brandID'];
        $i++;
    ?>
    <tr align = "center">
        <td><?php echo $i; ?></td>
        <td><?php echo $productName; ?></td>
        <td><img src="images/<?php echo $image;?>" width="60" height="60"/></td>
        <td><?php echo $price; ?></td>
        <td><a href="index.php?edit_pro=<?php echo $pro_id; ?>">Edit</a></td>
        <td><a href="delete_pro.php?delete_pro=<?php echo $pro_id;?>">Delete</a></td>
    </tr>
    <?php } ?>
</table>