 <!-- Modal -->
 <div class="modal fade" id="newmainspecialModal" tabindex="-1" role="dialog" >
        <div class="modal-dialog modal-sm" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="newmainspecialModal">Banner Specials</h5>
              <button type="button" class="close" data-dismiss="modal">
                <span>&times;</span>
              </button>
            </div>
            <form action="specialupload/upload.php" method="post" enctype="multipart/form-data">
            <div class="modal-body">
                <div class="row modalrow"  style="text-align:left!important;">
                    <div class="formlable col-xm-12 col-sm-12 col-md-12 col-lg-12">
                    Special Product:
                    </div>
                    <div class="col-xm-12 col-sm-12 col-md-12 col-lg-12">
                        <input class="specialinput" type="text" name="productName"/>
                    </div>
                </div>
                
               
                <div class="row modalrow" style="text-align:left!important;">
                    <div class="formlable col-xm-12 col-sm-12 col-md-12 col-lg-12">
                        Price:
                    </div>
                    <div class="col-xm-12 col-sm-12 col-md-12 col-lg-12">
                        <input class="specialinput" type="number" name="price"/>
                    </div>
                </div>

                <!-- upload img here -->
                <div class="row modalrow" style="text-align:left!important;">
                    <div class="formlable col-xm-12 col-sm-12 col-md-12 col-lg-12">
                        Select image to upload:
                    </div>
                    <div class="col-xm-12 col-sm-12 col-md-12 col-lg-12">
                        <input type="file" name="file[]" multiple />
                    </div>
                </div>

                <div class="row modalrow" style="text-align:left!important;">
                    <div class="formlable col-xm-12 col-sm-12 col-md-12 col-lg-12">
                        Special Deal information:
                    </div>
                    <div class="col-xm-12 col-sm-12 col-md-12 col-lg-12">
                    <textarea class="specialinput form-control" id="exampleFormControlTextarea1" rows="3" name="dealinfo"></textarea>
                    </div>
                </div>

            </div>
            <div class="modal-footer" style="text-align:center!important;">
              <input type="submit" class="btn btn-secondary" value="UPLOAD" name="submit" style="text-align:center!important; margin:0 auto; background-color: rgba(48, 43, 41,1);"/>
              <!-- <button type="submit" form="uploadimg" class="btn btn-primary"  name="submit">Submit</button> -->
            </div>
            </form>
          </div>
        </div>
      </div>

      

