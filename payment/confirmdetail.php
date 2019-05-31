
    <?php
    include_once ("../partials/head.php");
    $totalcart= $_GET['ordertotalcost'];
    $ordertotalquantity= $_GET['ordertotalquantity'];
    $note= $_GET['note'];
 	?>
	 <link rel="stylesheet" href="css/cart.css">
<article id="second">
<div class="container">
    <div class="row">

        <!-- info confirmation -->
        <div class="col-sm-12 col-lg-7">
            <form>
                <div class="contactinformation">
                    <div class="contacthead">Contact Information</div>
                        <div class="row">
                            <div class="col-6 usernamebox contactinformationbox">
                            <label for="lable">Your Name </label><br>
                            <input name="username" class="username" type="text" required>   
                            </div>
                            <div class="col-6 companynamebox contactinformationbox">
                            <label for="lable">Company Name </label><br>
                            <input name="companyname" class="companyname" type="text" required>   
                            </div>                            
                        </div>

                        <div class="row">
                             <div class="col-12 emailaddressbox contactinformationbox">
                                <label for="lable">Contact Email </label><br>
                                <input name="emailaddress" class="emailaddress" type="emal" required>   
                            </div>                        
                        
                            <div class="col-12 contactnumberbox contactinformationbox">
                                <label for="lable">Contact Number</label><br>
                                <input name="contactnumber" class="contactnumber" type="text" required>   
                            </div>                        
                    <div class="contacthead">Shipping Information</div>    
                          <div class="col-12 addressbox contactinformationbox">
                                <label for="lable">Delivery Address</label><br>
                                <input name="address" class="address" type="text" required>   
                            </div>                        
                        </div>
                </div> 
            </form> 
        </div>
        <!-- item confirmation -->
        <div class="col-sm-12 col-lg-5">
            <div class="sidecart">
           
            </div>
        </div>
        <div class="col-12 buttonarea">
          <button type="button" class="btn btn-secondary btn-sm" id="checkbutton">
              CONTINUE
              </a>
          </button>        
        </div>
    </div>  
</div>

</article>
<style>
.contacthead{
    font-size: 1.4rem;
    font-family: 'Lato', sans-serif;
    font-weight: 600;
    text-align:left;
    margin-bottom:10px;
}
.contactinformationbox input{
      
	  border: 1.6px solid #d9d9d9;
      border-radius: 5px;
      transition: all 1.5s cubic-bezier(.19,1,.22,1);
      font: 12px/1 effra;
      color: #333333;
      min-height: 40px;
      width: 100%;
     
}
.contactinformationbox label{
    font-family: 'Lato', sans-serif;
    color: #333333;
    font-size: 1rem;
    float:left;
    margin-bottom: 0;
}
.contactinformationbox{
    margin: 10px auto;
}
.sidecart{
    background-color: rgba(217, 221, 146, 1);
    border-radius: 5px;
    width:100%;
    height: 100%;
}
</style>