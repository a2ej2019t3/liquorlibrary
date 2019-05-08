
 <header>
        <nav class="navbar navbar-expand-lg navbar-inverse fixed-top opaque-navbar">
            <div class="container">
                <button type="button" class="btn btn-warning btn-sm trigger-btn" href="#myModal" data-toggle="modal" style="position:absolute; right: 35px; color:white!important; background-color: rgba(224, 184, 65, 1)!important; border:none;">Login</button>
                <br>
                <div class="navbar-header">
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navMain">
                      <span style="color:white;" id="iconarea"><i class="fas fa-angle-down"></i></span>
                    </button>
                    <a class="navbar-brand" href="index.php" style="font-size: 1.7rem; color: white; font-family: 'Cinzel', serif;">Liquor Library <br> <span style="font-size: 0.7rem; font-family: 'Open Sans', sans-serif; text-align: center; margin-left: 20px;">THE NEW INDUSTRY STANDARD</span></a>
                </div>
                <div class="collapse navbar-collapse" id="navMain">
                    <ul class="nav navbar-nav ml-auto">
                        <li class="col" id="firstcol"><a href="#aboutus" style="color: white; font-size: 1rem; font-family: 'Roboto', sans-serif;">About Us</a></li>
                        <li class="col"><a href="findlocation/findus.php" style="color: white; font-size: 1rem; font-family: 'Roboto', sans-serif;">Find Us</a></li>
                        <li class="col"><a href="#" style="color: white; font-size: 1rem; font-family: 'Roboto', sans-serif;">Our Drinks</a></li> 
                        <li class="col"><a href="#" style="color: white; font-size: 1rem; font-family: 'Roboto', sans-serif;">Specials</a></li> 
                        <li class="col"><a href="#" style="color: white; font-size: 1rem; font-family: 'Roboto', sans-serif;">Cart</a></li>
                        <li class="col"><a href="#" style="color: white; font-size: 1rem; font-family: 'Roboto', sans-serif;">My orders</a></li>
                        <li class="col"><a href="contact.php" style="color: white; font-size: 1rem; font-family: 'Roboto', sans-serif;">Contact</a></li> 
                        <li class="col"> 
                            <!-- modal button -->
                            <button type="button" class="btn btn-primary btn-lg pull-right" style="background-color: transparent; border:none;" data-toggle="modal" data-target="#modal2">
                                <span style="color: white; font-size: 20px; margin-top:10px;" id="b2"><i class="fas fa-search"></i></span> 
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
          </nav>     
                      
<!-- Login modal -->
                  <div id="myModal" class="modal fade" data-backdrop="false">
                      <div class="modal-dialog modal-login">
                          <div class="modal-content" style="height: 370px!important;">
                              <div class="modal-header">				
                                  <h4 class="modal-title">Sign in</h4>
                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                              </div>
                              <div class="modal-body">
                                  <form action="" method="post">
                                      <div class="form-group">
                                          <i class="fa fa-user"></i>
                                          <input type="text" class="form-control" placeholder="Username" required="required">
                                      </div>
                                      <div class="form-group">
                                          <i class="fa fa-lock"></i>
                                          <input type="password" class="form-control" placeholder="Password" required="required">					
                                      </div>
                                          <div class="form-group small clearfix">
                                              <label class="checkbox-inline"><input type="checkbox"> Remember me</label>
                                              <a href="#" class="forgot-link">Forgot Password?</a>
                                          </div>
                                      <div class="form-group">
                                          <input type="submit" class="btn btn-primary btn-block btn-lg" value="Sign in">
                                      </div>
                                  </form>
                              </div>
                              <div class="modal-footer">Don't have an account? <a href="signup.php">Sign up</a></div>
                          </div>
                      </div>
                  </div>
<!-- ------------ -->

<!-- search modal ----------------------------------------------------------------------------------------->
                  <div class="modal fade" id="modal2" tabindex="-1" data-trigger="hover">
                      <div class="modal-dialog modal-lg modal-center" id="modal3" style="margin-left: 8%!important;">
                          <div class="container">
                              <div class="modal-content">
                                  <div class="modal-body">
                                      <form>              
                                          <div class="row">
                                              <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                                                  <!-- add id for search function -->
                                                  <input id="searchbox" autocomplete="off" spellcheck="false" type="search" placeholder="Search by keywords, categories" style="width:100%; height:60px; border-top: 6px solid rgba(48, 43, 41,1);">
                                                  <div class="dropdown">
                                                  <!-- dropdown menu -->
                                                  <div id="dropdownarea" class="dropdown-menu" style="width:100%"></div>
                                                  <!-- dropdown menu end --> 
                                                  </div>  
                                              </div>
                                              <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                                <button id="submit" type="submit" class="btn btn-primary" style="width:100%; height:60px; background-color: rgba(48, 43, 41,1)!important; ">Submit</button>
                                              </div>                                          
                                          </div>
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                                      </form> 
                                  </div>  
                              </div>
                          </div> <!--  container ends -->
                    </div>
                    <div class="modal-footer">Don't have an account? <a href="signup.php">Sign up</a></div>
                  </div>
<!-- ------------ -->
</header> 
