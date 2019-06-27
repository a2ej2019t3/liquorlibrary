<div class="modal fade" id="branch_customeremail" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">CONTACT TO THIS CUSTOMER</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form role="form" method="post" action="Emailsending/branchinform_email.php">
        <p>
            Send your message to this customer in the form below.
        </p>
        <p>
           this email will be sent under the company name.
        </p>
        <div class="form-group">
            <input type="hidden" name="brnachname" value="<?php echo $_SESSION['warehouse']['whName'] ?>">
            <input type="hidden" name="branchID" value="<?php echo $_SESSION['warehouse']['whID'] ?>">
            <input type="hidden" id="questionorder" name="questionorder">
            <input type="hidden" id="buyerid" name="buyerID">
            <!-- <input type="text" id="order" name="questionorder">
            <input type="text" id="buyer" name="buyerID"> -->
        </div>
        <div class="form-group">
            <label for="email">
                Email:</label>
            <input type="email" class="form-control"
            id="email" name="email" required maxlength="50" placeholder="input the email you wish to get an reply to">
        </div>
        <div class="form-group">
            <label for="name">
                Message:</label>
            <textarea class="form-control" type="textarea" name="message"
            id="message" placeholder="Your Message Here"
            maxlength="6000" rows="7"></textarea>
        </div>
        <button type="submit" class="btn btn-lg btn-success btn-block" id="sendbutton" name="branchinformform" style="height:100%;" onclick="sendspin();"> <span id="sendsign" >SEND NOW</span>
        <span class="spinner-border spinner-border-sm" id="sendspinner" role="status" aria-hidden="true" style="display:none; text-align:center; margin: 10px auto;"></span>
        </button>

    </form>
      </div>
    </div>
  </div>
</div>

<style>
label{
    float: left;
    margin-left: 15px;
}

</style>
<script>
function sendspin(){

var spinner='#sendspinner';
var sign='#sendsign';

$(spinner).css("display","block");
$(sign).css("display","none");
// setTimeout( "$('#spinner').css('display','none');", 8000);
window.setTimeout(function(){
$(spinner).css('display','none');
$(sign).css("display","block");
}, 5000);
}
</script>