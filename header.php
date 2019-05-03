
 <header>

        <div class="navbar navbar-inverse navbar-fixed-top opaque-navbar">
                <div class="container">
                    <span>  <a href="#myModal" class="trigger-btn" data-toggle="modal" style=" background-color: transparent; border:  none; color:  white; text-decoration: underline; position:absolute; right: 35px;">Login</a></span>
                  <br>
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
                    <div class="navbar-header">
                    
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navMain">
                <span class="glyphicon glyphicon-chevron-right" style="color:white;"></span>
                  
                </button>
                    <a class="navbar-brand" href="#" style="font-size: 2.7rem; color: white; font-family: 'Cinzel', serif;">Liquor Library <br> <span style="font-size: 1.2rem; font-family: 'Open Sans', sans-serif; text-align: center; margin-left: 20px;">THE NEW INDUSTRY STANDARD</span></a>
                  </div>
                  <div class="collapse navbar-collapse" id="navMain">
                    <ul class="nav navbar-nav pull-right">
                      <li class="active"><a href="#aboutus" style="color: white; font-size: 1.6rem; font-family: 'Roboto', sans-serif;">About Us</a></li>
                      <li><a href="#" style="color: white; font-size: 1.6rem; font-family: 'Roboto', sans-serif;">Find Us</a></li>
                      <li><a href="#" style="color: white; font-size: 1.6rem; font-family: 'Roboto', sans-serif;">Our Drinks</a></li> 
                      <li><a href="#" style="color: white; font-size: 1.6rem; font-family: 'Roboto', sans-serif;">Specials</a></li> 
                      <li><a href="#" style="color: white; font-size: 1.6rem; font-family: 'Roboto', sans-serif;">Cart</a></li>
                      <li><a href="#" style="color: white; font-size: 1.6rem; font-family: 'Roboto', sans-serif;">My orders</a></li>
                      <li><a href="contact.php" style="color: white; font-size: 1.6rem; font-family: 'Roboto', sans-serif;">Contact Us</a></li> 
                      <li> 
                        <!-- modal button -->
                          <button type="button" class="btn btn-primary btn-lg pull-right" style="background-color: transparent; border:none;" data-toggle="modal" data-target="#modal2">
                            <span class="glyphicon glyphicon-search" style="color: white; font-size: 20px; margin-top:10px;" id="b2"></span> 
                          </button>
                          <!-- search modal ----------------------------------------------------------------------------------------->
                          <div class="modal fade" id="modal2" tabindex="-1" role="dialog" aria-labelledby="modal2Label" aria-hidden="true" data-trigger="hover">
                          <div class="modal-dialog modal-lg modal-center" id="modal3" style="margin-left: 8%!important;">
                             
                             <div class="container">
                                <div class="modal-content">
                                  <div class="modal-body">
                                    
                                      <form>
                                        
                                        <div class="row">
                                          
                                          <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                                              <input type="text" placeholder="Search by keywords, categories" style="width:100%; height:60px; border-top: 6px solid rgba(48, 43, 41,1); ">
                                          </div>
                                          <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                            <button id="submit" type="submit" class="btn btn-primary" style="width:100%; height:60px; background-color: rgba(48, 43, 41,1)!important; ">Submit</button>
                                          </div>                                          
                                        </div>
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                                      </form> 
                                    </div>  
                                  </div>
                                  <!-- <div class="modal-footer">
                                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                  </div> -->
                              </div>
                          </div>
                      </div>
                          <!-- - ------------------------------------------------------------------------------------------------>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>     
            
</header> 