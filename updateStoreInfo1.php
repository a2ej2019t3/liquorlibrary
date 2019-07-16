<?php
session_start();
$_SESSION['location'] = 'updatestoreinfo1';
include_once('connection.php');
include_once('database/DBsql.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Branch Admin Dashboard</title>
    <?php
    include_once("partials/head.php");
    ?>
    <link rel="stylesheet" href="css/branchreport.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">


    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<!-- <section>
        <?php
        include_once("partials/header.php");
        ?>        
</section> -->
<div class="well">
    <ul class="nav nav-tabs">
        <li><a href="#home" data-toggle="tab" class="mytabs">Store Information</a></li>
        <li><a href="#update" data-toggle="tab" class="mytabs">Manager Info</a></li>
    </ul>
    <div id="myTabContent" class="tab-content">
        <div class="tab-pane active in" id="home">
            <form id="tab">
                <div class="card1">
                    <div class="card-body">
                        <div class="col-sm-3">
                            <h4>StoreID:</h4>
                            <h4>StoreName:</h4>
                            <h4>Email:</h4>
                            <h4>Contact Info:</h4>
                            <h4>Address:</h4>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <h6><?php echo (!empty($user['storeID'])) ? $user['storeID'] : 'N/a'; ?></h6>
                    <h6><?php echo (!empty($user['storeName'])) ? $user['storeName'] : 'N/a'; ?></h6>
                    <h6><?php echo (!empty($user['email'])) ? $user['email'] : 'N/a'; ?></h6>
                    <h6><?php echo (!empty($user['phone'])) ? $user['phone'] : 'N/a'; ?></h6>
                    <h6><?php echo (!empty($user['address'])) ? $user['address'] : 'N/a'; ?></h6>
                </div>
                <!-- <div>
        	    <button class="btn btn-primary">Update</button>
        	</div> -->
            </form>
        </div>
        <div class="tab-pane in" id="update">
            <form id="tab2">
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4>Your Profile</h4>
                                    <hr>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <form>
                                        <div class="box box-solid">
                                            <div class="box-body">
                                                <div class="col-sm-9">
                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <h4>Name:</h4>
                                                            <h4>Email:</h4>
                                                            <h4>Contact Info:</h4>
                                                            <h4>Address:</h4>
                                                            <h4>Member Since:</h4>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <!-- <h4><?php echo $user['firstname'] . ' ' . $user['lastname']; ?> -->
                                                        <span class="pull-right">
                                                            <a href="#edit" class="btn btn-success btn-flat btn-sm" data-toggle="modal"><i class="fa fa-edit"></i> Edit</a>
                                                        </span>
                                                        <!-- </h4> -->

                                                        <!-- <h4><?php echo $user['email']; ?></h4> -->
                                                        <!-- <h4><?php echo (!empty($user['contact_info'])) ? $user['contact_info'] : 'N/a'; ?></h4>
	        							<h4><?php echo (!empty($user['address'])) ? $user['address'] : 'N/a'; ?></h4> -->
                                                        <!-- <h4><?php echo date('M d, Y', strtotime($user['created_on'])); ?></h4> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
include_once("partials/foot.php");


?>
<?php
include_once("profile_modal1.php");
?>

</body>

</html>
<!-- <?php
        //  }
        //     }
        ?> -->

<style>
    .nav>li>a:hover,
    .nav>li>a:focus {
        text-decoration: none;
        background-color: yellow !important;
    }
</style>