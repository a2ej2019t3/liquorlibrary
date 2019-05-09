<!-- sub Category modal ----------------------------------------------------------------------------------------->
<?php
  include ('connection.php');
    $parentCategory_sql="SELECT `categoryID`, `categoryName` FROM `category` WHERE `parentCategoryID` IS NULL";
    $parentCategory_res = mysqli_query($conn, $parentCategory_sql);
    if ($parentCategory_res != "") {
        $parentCategory_arr = mysqli_fetch_all($parentCategory_res);
    } else {
        alert(" parent category result empty");
    }

        echo'
            <div class="modal fade" id="subnav" tabindex="-1" data-trigger="hover" data-backdrop="false">
                <div class="modal-dialog modal-md modal-center" style="max-width: 70%!important;">
                    <div class="container">
                        <div class="modal-content">
                            <div class="modal-body"style="max-height: 250px!important;">
                            <div class="tab">';
                
                        if (count($parentCategory_arr) != 0) { 
                            echo '
                             <button id="buttonIndex_0" type="button" class="tablinks" onclick="openCity(this.id)" value="'.$parentCategory_arr[0][1].'">'.$parentCategory_arr[0][1].'</button>
                            ';
                            for ($a = 1; $a < count($parentCategory_arr); $a++) {
                                // parent category list showing
                                $cityName= $parentCategory_arr[$a][1];
                                echo '
                                <button type="button" id="buttonIndex_'.$a.'" class="tablinks" onclick="openCity(this.id)" value="'.$cityName.'">'.$cityName.'</button>
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
                                <div id="'.$parentCategory_arr[$a][1].'" class="tabcontent">
                                <h4>'.$parentCategory_arr[$a][1].'</h4>';
                            
                                $subCategory_sql="SELECT `categoryID`, `categoryName` FROM `category` WHERE `parentCategoryID` =".$parentCategory_arr[$a][0]."";
                                $subCategory_res = mysqli_query($conn, $subCategory_sql);
                                if ($subCategory_res != "") {
                                    $subCategory_arr = mysqli_fetch_all($subCategory_res);
                                } else {
                                    alert("sub category result empty");
                                }
                                for ($b = 0; $b < count($subCategory_arr); $b++) {
                                    echo '<button><a href="productlist.php">'.$subCategory_arr[$b][1].' </a></button> <br>';
                                };
                       

         echo                  
                             '</div>';  
                            } 
                
                        } else {
                        
                        };
            
                echo '     <button type="button" class="close" data-dismiss="modal" id="tabclose"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                    </div>  
                </div>
            </div>
        </div>
    </div>';
    ?>
 