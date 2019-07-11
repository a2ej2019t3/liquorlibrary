<?php
    include(__DIR__ . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'DBsql.php');
    $DBsql = new sql;
    
    $cartID = $_GET['oi'];
    echo $cartID;
    $res = $DBsql->getOrderInfo($cartID, null);
    // var_dump($res);
    $tagForCategory = 'Category: ';
    $tagForBrand = 'Brand: ';
    $tagForPrice = 'Price: ';
    $imgpath = 'images/';
echo '
<div class="row">
    <div class="col-4 text-left">
 ';
// for ($b = 0; $b < count($res); $b++) {
    $userinfo = $DBsql->select('users', array('userID'=>$res[0]['buyerID']));
    if ($res[0]['deliverymethod'] == 'delivery') {
        // var_dump($userinfo);
    echo '
        <div class="row">
            <h5 class="secondHeader">Ship To</h5>
        </div>
        <div class="row">
            <h5>'.$userinfo[0]['firstName'].' '.$userinfo[0]['lastName'].'</h5>
        </div>
        <div class="row">
            <h5 class="secondHeader">Receiving Address</h5>
        </div>
        <div class="row">
            <h5 style="text-align:left;">'.$userinfo[0]['address'].'</h5>
        </div>
        <div class="row">
            <h5 class="secondHeader">Your Email</h5>
        </div>
        <div class="row">
            <h5>'.$userinfo[0]['email'].'</h5>
        </div>
        <div class="row">
            <h5 class="secondHeader">Your Phone</h5>
        </div>
        <div class="row">
            <h5>'.$userinfo[0]['phone'].'</h5>
        </div>';
    } else if ($res[0]['deliverymethod'] == 'pickup') {
        $storeinfo = $DBsql->select('warehouse', array('whID'=>$res[0]['whID']));
    echo '
        <div class="row">
            <h5 class="secondHeader">Name</h5>
        </div>
        <div class="row">
            <h5>'.$userinfo[0]['firstName'].' '.$userinfo[0]['lastName'].'</h5>
        </div>
        <div class="row">
            <h5 class="secondHeader">Pick Up Address</h5>
        </div>
        <div class="row">
            <h5>'.$storeinfo[0]['address'].'</h5>
        </div>
        <div class="row">
            <h5 class="secondHeader">Store Email</h5>
        </div>
        <div class="row">
            <h5>'.$storeinfo[0]['email'].'</h5>
        </div>
        <div class="row">
            <h5 class="secondHeader">Store Phone</h5>
        </div>
        <div class="row">
            <h5>'.$storeinfo[0]['phone'].'</h5>
        </div>';
    }
    if ($res[0]['note'] !== null && $res[0]['note'] !== '') {
        echo '
        <div class="row">
            <h5 class="secondHeader">Note</h5>
        </div>
        <div class="row">
            <h5>'.$res[0]['note'].'</h5>
        </div>';
    }
// }
    echo '
    </div>';
    echo '
    <div class="col-8">';
    for ($b = 0; $b < count($res); $b++) {
    echo '
        <div class="row" style="width: 100%; margin:0;">
                <div class="container" style="left:0;">
                    <div class="row">
                        <div class="col">
                            <div class="row" style="min-height:80px;">

                                <div id="posterarea" class="col" 
                                style="max-width: 50px;
                                min-width: 25px;
                                padding: 0 0 0 10px !important;
                                margin: auto;
                                text-align: center;">
                                    <img class="img-fluid" src='.$imgpath.$res[$b]['img'].' style = "max-height:70px;">
                                </div>

                                <div id="titlearea" class="col" style="padding:0 0 0 5px; margin:auto;">
                                    <p style="color:black; text-align:left; margin:0;">
                                        <b>'.$res[$b]['productName'].'</b><br>
                                        <a href="../categorysearch.php?searchcategoryID='.$res[$b]['categoryID'].'&searchcategoryName='.$res[$b]['categoryName'].'&location=category"><i style="font-size">'.$tagForCategory.$res[$b]['categoryName'].'</i></a><br>
                                        <a href="../categorysearch.php?brandname='.$res[$b]['brandName'].'&location=brandproduct"><i>'.$tagForBrand.$res[$b]['brandName'].'</i></a>
                                    </p>
                                </div>

                            </div>
                        </div>
                        <div class="col" style="padding:0;">
                            <div class="row">

                                <div id="quantityCol" class="col" style="margin-top:15px;">
                                    <div class="row">
                                        <div class="col">
                                            <h5>&times;'.$res[$b]['quantity'].'</h5>
                                        </div>
                                        <div class="col">
                                            <h5>NZ$'.$res[$b]['totalprice'].'</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr style="margin:0;">';
    }
    
    echo '
        <div class="col">
            <div class="row">
                <div class="col">
                    <h6 class="secondHeader">Total:</h5>
                </div>
                <div class="col">
                    <h6 class="pr-3">NZ$'.$res[0]['cost'].'
                </div>
            </div>
            <div class="row">
            <div class="col">
                <h6 class="secondHeader">Transaction:</h5>
            </div>';
    if ($res[0]['paymentmethod'] == 'card') {
    echo '
                <div class="col">
                    <h6 class="pr-3">'.$res[0]['transactionID'].'
                </div>';
    } else if ($res[0]['paymentmethod'] == 'cash') {
    echo '
                <div class="col">
                    <h6 class="pr-3">Pay by cash</h5>
                </div>';
    } else {
    echo '
                <div class="col">
                    <h6 class="pr-3"></h5>
                </div>';
    }
echo '
            </div>
        </div>
        <div class="d-flex justify-content-end">
            <button type="button" class="reorderBtn btn-sm btn-primary" data-roid="'. $res[0]['orderID'] .'" style="width:150px;">
                Reorder
            </button>
        </div>
    </div>
</div>';