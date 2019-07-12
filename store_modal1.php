<!-- Edit Profile -->
<div class="modal fade" id="editstore">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><b>Update Store Details</b></h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" method="POST" action="store_edit.php" enctype="multipart/form-data">
     
          <div class="form-group">
            <label for="storeEmail" class="col-sm-3 control-label">Email</label>

            <div class="col-sm-9">
              <input type="text" class="form-control" id="storeEmail" name="storeEmail" value="<?php echo $_SESSION['warehouse']['email']; ?>">
            </div>
          </div>
          <div class="form-group">
            <label for="storeContact" class="col-sm-3 control-label">Contact Info</label>

            <div class="col-sm-9">
              <input type="text" class="form-control" id="storeContact" name="storeContact" value="<?php echo $_SESSION['warehouse']['phone']; ?>">
            </div>
            <!-- <div class="form-group">
              <label for="address" class="col-sm-3 control-label">Address</label>

              <div class="col-sm-9">
                <input type="text" textarea class="form-control" id="address" name="address" value="<?php echo $user['address']; ?>"></textarea>
              </div>
            </div> -->
            <hr>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            <button type="submit" class="btn btn-success btn-flat" name="storeedit"><i class="fa fa-check-square-o"></i> Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- store details -->



