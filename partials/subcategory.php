<!-- sub Category modal ----------------------------------------------------------------------------------------->
<?php
  include ('connection.php');
    $parentCategory_sql="SELECT `categoryID`, `categoryName` FROM `category` WHERE `parentCategoryID` IS NULL";
    $parentCategory_res = mysqli_query($connection, $parentCategory_sql);
    if ($parentCategory_res != "") {
        $parentCategory_arr = mysqli_fetch_all($parentCategory_res);
    } else {
        alert(" parent category result empty");
    }

        echo'
            <div class="modal" id="subnav" tabindex="-1" data-trigger="hover" data-backdrop="false">
                <div class="modal-dialog modal-center style="max-width: 700px!important; max-height: 360px!important;">
                    <div class="container">
                        <div class="row">
                        <div class="modal-content" style="width:400px;">
                            <div class="modal-body" id="modalcard" style="padding:0; width: 400px;">';
         echo                  '<div class="tab col-3">';
                
                        if (count($parentCategory_arr) != 0) { 
                            echo '
                              <button id="buttonIndex_0" type="button" class="tablinks" onclick="openCity(this.id)" value="'.$parentCategory_arr[0][1].'"><span>'.$parentCategory_arr[0][1].'</span></button>
                            ';
                            for ($a = 1; $a < count($parentCategory_arr); $a++) {
                                // parent category list showing
                                $cityName= $parentCategory_arr[$a][1];
                                echo '
                                <button type="button" id="buttonIndex_'.$a.'" class="tablinks" onclick="openCity(this.id)" value="'.$cityName.'"><span>'.$cityName.'</span></button>
                                ';
                               
                            }
                
                        } else {
                        
                        };
         echo
                        '</div>';
        
                        if (count($parentCategory_arr) != 0) { 
                            for ($a = 0; $a < count($parentCategory_arr); $a++) {
                                // change form action to desired php file 
                                echo '
                                <div id="'.$parentCategory_arr[$a][1].'" class="tabcontent col-9">
                                <h5 style="color:  #8B0000;">'.$parentCategory_arr[$a][1].'</h5> <hr style="margin: 10px auto!important;">';
                            echo '<div class="row">';
                                $subCategory_sql="SELECT `categoryID`, `categoryName` FROM `category` WHERE `parentCategoryID` =".$parentCategory_arr[$a][0]."";
                                $subCategory_res = mysqli_query($connection, $subCategory_sql);
                                if ($subCategory_res != "") {
                                    $subCategory_arr = mysqli_fetch_all($subCategory_res);
                                } else {
                                    alert("sub category result empty");
                                }
                                for ($b = 0; $b < count($subCategory_arr); $b++) {
                                    echo '<div class="column">';

                                    echo '<a class="linkanchor" href="categorysearch.php?searchcategoryID='.$subCategory_arr[$b][0].'&searchcategoryName='.$subCategory_arr[$b][1].'" > '.$subCategory_arr[$b][1].'</a> <br>';
                                   
                                    echo '</div>';
                                };
                            echo '</div>';

         echo                  
                             '</div>
                             ';  
                            } 
                            echo ' <button type="button" class="close" data-dismiss="modal" id="tabclose" style="position: absolute; bottom: 19px; right: 30px;"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span>';
                        } else {
                        
                        };
            
                echo '   <br>
                        </div>  
                   </div>     
                </div>
            </div>
        </div>
    </div>';
    ?>
 <style>
  .linkanchor{
    color: black!important;
  }
  .linkanchor:hover, .linkanchor:active{
    color: black!important;
    text-decoration: none;
  }
</style>