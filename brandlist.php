<?php
include ('connection.php');
echo '
<div class="container_fluid">
    <div class="row">
<!-- content body starts -->
        <div class="productresult col-md-9 col-xs-12 content-right">
            <!-- product list results -->
            <div style="margin-top: 100px; "><hr><span style="font-size:24px;">Shop By Brand </span>
                <hr>
                <div style="text-align:left;"><i class="far fa-compass" style="margin: 10px 10px;"></i><a style="color: black!important; text-decoration: none!important;" href="index.php">Home / </a> <span>All brands</span></div>
                <span class="aphabetcontainer">
                    ';
                    foreach (range('A', 'Z') as $char) {
                        echo '<a href="#'.$char.'"><button class="alphabetbutton">'.$char.'</button></a>';
                    }
          echo '</span>
                <hr>';
                    // <!-- Brand List Loop -->
                echo '
                <section>
                    <article id="content">
                        <div class="conatiner-fluid">
                ';
                            foreach (range('A', 'Z') as $char) {/* foreach loop sstarts */
                                echo '<div class="row">';
                                echo '<div class="rowbox col-sm-12 col-md-12 col-lg">';
                                echo '<div class="alphabetbox">';
                                echo '<span class ="alphatitle" id="'.$char.'">'.$char.'</span><hr style="margin-top:0!important;">
                                    </div>';
                                    
                                $searchBrandlist_sql = "SELECT brandID, brandName FROM brand WHERE LEFT(brandName ,1)='$char'";
                                
                                $searchBrandlist_res = mysqli_query($connection, $searchBrandlist_sql);
                                
                                if ($searchBrandlist_res != "") {
                                    $searchBrandlist_arr = mysqli_fetch_all($searchBrandlist_res);
                                    
                                } else {
                                    // alert("result empty");
                                }
                                echo '<div class="namebox">'; 
                                // printing brand names in for loop
                                    echo '<div class="row">';
                                    for ($b = 0; $b <count($searchBrandlist_arr); $b++) {
                                        $brandlistArr = array(
                                                            'searchPara' => "?brandname=".$searchBrandlist_arr[$b][1]."&location=brandproduct",
                                                            'location' => "brandproduct"
                                                            );
                                        $brandlistJson = json_encode($brandlistArr);
                                        echo '<div class="col-md-4 col-lg-4">';
                                                echo '<span>
                                                <form style="margin: 0; padding: 0; display: inline;">
                                                    <button class="namebutton" type="button" value='.$brandlistJson.' onclick="showProduct(this.value)">'.$searchBrandlist_arr[$b][1].'</button>
                                                </form>
                                        </span>';
                                        echo '</div>'; /* col ends */
                                    };
                                    echo '</div>'; /* namebox row ends */
                                // for loop ends
                                
                                echo '</div>';
                                echo '</div>';  /* col-12  ends */
                                echo '</div>';  /* row  ends */
                            } /* foreach loop ends */
echo "

                        </div> <!----container ends------>
                    </article>
                </section>
            </div>
        </div>
    </div>
</div>
<style>
/* 
font-family: 'Lato', sans-serif;
font-family: 'Shadows Into Light', cursive;
font-family: 'Cinzel', serif;
font-family: 'Roboto', sans-serif;
font-family: 'Open Sans', sans-serif;
font-family: 'Montserrat', sans-serif;
font-family: 'Playfair Display', serif;
*/
.body{
   height: 100%;
   width: 100%;
   scroll-behavior: smooth;
   margin:0;
   padding:0;
   font-family: 'Montserrat', sans-serif;
}
.aphabetcontainer{
   border-top: 1.5px solid rgba(244, 232, 117, 1);
   padding-top:10px;
}
.alphabetbox{
   text-align:left;
   margin-bottom:0;
}
.alphatitle{
   text-align: left;
   font-family: 'Cinzel', serif;
   font-weight: 600;
   font-size: 2.9rem;
   margin-left: 75px;
}

.alphabetbutton{
   background-color: transparent;
   border: none;
   color: rgba(48, 43, 41,1);
   margin: 10px auto;
}
.alphabetbutton:hover{
    color: rgba(224, 184, 65, 1);
}

.namebutton{
   background-color: transparent;
   border: none;
   color: rgba(48, 43, 41,1);
   margin: 10px auto;
   display: inline;
   font-size: 15px;
}
.namebutton:hover{
    background-color: rgba(224, 184, 65, 1);
}
.rowbox{
   text-align: center;
}
.namebox{
   width: 70%;
   margin: 0;
   padding: 0;
   margin: 15px auto;
   text-align: center;
}
</style>
";
