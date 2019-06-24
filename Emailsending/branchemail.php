<div class="modal fade" id="branchemail" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">CONTACT TO ADMIN</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form role="form" method="post" action="Emailsending/branchrequest_email.php">
        <p>
            Send your message to admin in the form below.
        </p>

        <div class="form-group">
            <input type="hidden" name="brnachname" value="<?php echo $_SESSION['warehouse']['whName'] ?>">
            <input type="hidden" name="branchID" value="<?php echo $_SESSION['warehouse']['whID'] ?>">
            <input type="hidden" id="questionorder" name="questionorder">
            <label for="name">
                Name:</label>
            <input type="text" class="form-control"
            id="name" name="name"   required maxlength="50">
        </div>
        <div class="form-group">
            <label for="email">
                Email:</label>
            <input type="email" class="form-control"
            id="email" name="email" required maxlength="50">
        </div>
        <div class="form-group">
            <label for="name">
                Message:</label>
            <textarea class="form-control" type="textarea" name="message"
            id="message" placeholder="Your Message Here"
            maxlength="6000" rows="7"></textarea>
        </div>
        <button type="submit" class="btn btn-lg btn-success btn-block" name="branchrequestform"> SEND NOW</button>

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