<?php
    session_start();
    $_SESSION['location'] = 'productlist';
    include_once ('connection.php');
    // Sale product search 
    // $_SESSION['ref'] = $SERVER['QUERYSTRING'];
 ?>


 <!DOCTYPE html>
 <html lang="en">
 <head>
 <?php
    include_once ("partials/head.php");
  ?>
 
<title>Product_listbySale</title>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script>
      $(document).ready(function(){
        // Set trigger and container variables
        var trigger = $('.sortselect option'),
            container = $('#content');
            
        // Fire on click
        trigger.on('click', function(){
          // Set $this for re-use. Set target from data attribute
          var $this = $(this),
            target = $this.find(':selected').data('target');       
            
          // Load target page into container
          container.load(target + '.php');  
          // Stop normal link behavior
          return false;
        });
      });
    </script>
</head>
<body>
    <section>
        <?php
            include_once ("partials/header.php");
        ?>        
     </section>
     <br><br>
<?php
 include ("Cart/stickycart.php");
?>
<div class="container_fluid">
    <div class="row">
<!-- content body starts -->
        <div class="sidenavbar col-md-3 col-xs-12 content-left" style="text-align:center;">
            <!-- sideNave -->
                <?php
                    include_once ("partials/sideNav.php");
                ?>
        </div>

        <div class="productresult col-md-9 col-xs-12 content-right">
            <!-- product list results -->
            <div style="margin-top: 100px; "><hr><span style="font-size:24px;">Sale products</span>
            <select class="sortselect" name="sortselect" id="selectsort" style="width: 300px;margin-left: 15px;">                             
                                                <option data-target="onsalelist">ALL ITEMS</option>
                                                <option data-target="discountrate" >BY DISCOUNT RATE</option>
                                                <option value="ASC"  data-target="pricesort">BY LOW PRICE</option>
                                                <option value="DESC" data-target="pricesorthigh" onclick="pricesorthigh()">BY HIGH PRICE</option>
                                                <button type="submit"></button>
                                                </select>
            </div>
               <article id="content">
                <?php
                include_once ("onsalelist.php");
                ?>
                </article>
        
        </div>

    </div>

</div>

 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/sub.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
    <script type="text/javascript" src="js/search.js"></script>
 </body>


 </html>