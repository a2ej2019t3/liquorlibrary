<div class="modal fade" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><b>Update Account</b></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="profile_edit.php" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="firstname" class="col-sm-3 control-label">Firstname</label>

                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="firstName" name="firstName" value="<?php echo $_SESSION['user']['firstName']; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="lastname" class="col-sm-3 control-label">Lastname</label>

                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="lastName" name="lastName" value="<?php echo $_SESSION['user']['lastName']; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-sm-3 control-label">Email</label>

                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="email" name="email" value="<?php echo $_SESSION['user']['email']; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="contact" class="col-sm-3 control-label">Contact Info</label>

                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="contact" name="contact" value="<?php echo $_SESSION['user']['phone']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="address" class="col-sm-3 control-label">Address</label>

                            <div class="col-sm-9">
                                <input type="text" textarea class="form-control" id="address" name="address" value="<?php echo $_SESSION['user']['address']; ?>"></textarea>
                            </div>
                        </div>
                        <hr>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                        <button type="submit" class="btn btn-success btn-flat" name="editbb"><i class="fa fa-check-square-o"></i> Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>