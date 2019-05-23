<?php
    session_start();
    $_SESSION['location'] = 'productlist';
    include ('connection.php');
    //  Brand list 
    
        // $_SESSION['brandnamesearch'] = $_GET['brandname'];
        $searchcontent = $_GET['brandname'];
        // echo $_GET['brandname'];

    // $searchcontent = $_SESSION['brandnamesearch'];

    $searchSale_sql = "SELECT p.productID, p.img, p.productName, p.discountprice, p.price,p.categoryID, b.brandName, c.categoryName,c.categoryID FROM product AS p, brand AS b, category AS c WHERE p.brandID=b.brandID and p.categoryID=c.categoryID and b.brandName = '$searchcontent'";
    $searchSale_res = mysqli_query($connection, $searchSale_sql);
    
    if ($searchSale_res != "") {
        $searchSale_arr = mysqli_fetch_all($searchSale_res);
        $resultcount=count($searchSale_arr);
    } else {
        echo 'jhghjg';
        print_r($searchSale_arr);
        // alert("result empty");
    }
 ?>
<section>
<div class="container" style="padding-right: 45px;">
                
                
<?php
        include ('partials/saleproductprint.php');
    ?>
               
        
        </div>
 </section>
 <style>
.body{
    height: 100%;
    width: 100%;
    scroll-behavior: smooth;
    margin:0;
    padding:0;
    font-family: 'Montserrat', sans-serif;
}
.aphabetcontainer{
    border-top: 1.5px solid rgba(244, 232, 117, 1);
    padding-top:10px;
}
.alphabetbox{
    text-align:left;
    margin-bottom:0;
}
.alphatitle{
    text-align: left;
    font-family: 'Cinzel', serif;
    font-weight: 600;
    font-size: 2.9rem;
    margin-left: 75px;
}

.alphabetbutton{
    background-color: transparent;
    border: none;
    color: rgba(48, 43, 41,1);
    margin: 10px auto;
 }
 .alphabetbutton:hover{
     color: rgba(224, 184, 65, 1);
 }

</style>