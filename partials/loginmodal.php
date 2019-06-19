          <!-- Login modal -->
          <div id="myModal" class="modal fade" data-backdrop="false">
            <div class="modal-dialog modal-login">
                
              <div class="modal-content userlogin" style="height: 370px!important; border: 1px solid rgba(124, 99, 84, 1);">
              <button class="adminbtn" onclick="adminmode();"><i class="fas fa-user-shield"></i></button>
              <button class="branchbtn" onclick="branchmode();"><i class="fas fa-cash-register"></i></button>
              <div class="modal-header">				
                    <h4 class="modal-title">Sign in</h4>
                    <br>
                    <span id="admingreet" style="position: absolute;top: 60px;">Welcome, Admin.</span>
                    <span id="branchgreet" style="position: absolute;top: 60px;"> Welcome, This is a Branch login.</span>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form>
                        <!-- <span class="adminbtn"><i class="fas fa-user-shield"></i></span> -->
                        <div class="form-group">
                          <i class="fa fa-user"></i>
                          <input type="text" name="email" class="form-control" placeholder="Username" required="required">
                        </div>
                        <div class="form-group">
                          <i class="fa fa-lock"></i>
                          <input type="password" id="psw" name="password" class="form-control" placeholder="Password" required="required">					
                        </div>
                        <div class="form-group small clearfix">
                            <label class="checkbox-inline"><input type="checkbox"> Remember me</label>
                            <a href="#" class="forgot-link">Forgot Password?</a>
                        </div>
                        <div class="form-group">
                            <input type="button" id="loginSubmit" class="btn btn-primary btn-block btn-lg logbutton" value="Sign in">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">Don't have an account? <a href="signup.php">Sign up</a></div>
            </div>
        </div>
    </div>
    <script>
(function() {
    var psw = document.getElementById('psw');
    psw.addEventListener('keypress', function(event) {
        if (event.keyCode == 13) {
            event.preventDefault();
            document.getElementById('loginSubmit').click();
        }
    });
}());


      </script>
<style>
.adminbtn{
  position: absolute;
  top: -29px;
  right: 60px;
  z-index: 100;
  border: 1px solid #12b5e5;
  background-color: #12b5e5;
  width: 40px;
  height: 30px;
  border-top-left-radius: 25px;
  border-top-right-radius: 25px;
  color: white;
  border-bottom: 1px solid black;
}
.branchbtn{
  position: absolute;
  top: -29px;
  right: 20px;
  z-index: 100;
  border: 1px solid rgba(48, 43, 41,1);
  background-color: rgba(48, 43, 41,1);
  width: 40px;
  height: 30px;
  border-top-left-radius: 25px;
  border-top-right-radius: 25px;
  border-bottom: 1px solid black;
  color: white;  
}

.invisiblebtn{
    border: none;
    background-color: transparent;
    padding:0;
    margin:0;
}
#admingreet, #branchgreet{
    display: none;
}
/* admin login */
.adminlogin{
    background-color:burlywood;
    border: 1px solid burlywood;
}
.adminlogin #admingreet{
    display: block;
}
.adminlogin #loginSubmit{
    background-color:black;
}

/* branch login */
.branchlogin{
    background-color: silver;
    border: 1px solid silver;
}
.branchlogin #branchgreet{
    display: block;
}
.branchlogin #loginSubmit{
    background-color:black;
}
</style>