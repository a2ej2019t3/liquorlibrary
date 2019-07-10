<div class="modal fade" id="adminemail_tobranch" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">CONTACT TO THIS BRANCH STAFF</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form role="form" method="post" action="Emailsending/adminrequest_email.php">
        <p>
            Send your message to this staff in the form below.
        </p>

        <div class="form-group">

            <label for="name">
                Subject:</label>
            <input type="text" class="form-control"
            id="subject" name="subject"   required maxlength="50">
        </div>
        <div class="form-group">
            <label for="email">
                Email:</label>
            <input type="email" class="form-control" value="<?php echo $_SESSION['user']['email']?>"
            id="email" name="email" required maxlength="50">
        </div>

        <div class="form-group">
        <input type="hidden"  name="TobranchID" id="TobranchID">
            <label for="name">
                Message:</label>
            <textarea class="form-control" type="textarea" name="message"
            id="message" placeholder="Your Message Here"
            maxlength="6000" rows="7"></textarea>
        </div>
        <button type="submit" class="btn btn-lg btn-success btn-block" id="sendbutton" name="branchrequestform" style="height:100%;" onclick="sendspin();"> <span id="sendsign" >SEND NOW</span>
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