<?php
include_once ('connection.php');
    $parentCategory_sql="SELECT `categoryID`, `categoryName` FROM `category` WHERE `parentCategoryID` IS NULL";
    $parentCategory_res = mysqli_query($conn, $parentCategory_sql);
    if ($parentCategory_res != "") {
        $parentCategory_arr = mysqli_fetch_all($parentCategory_res);
    } else {
        alert(" parent category result empty");
    }
?>
<hr style="margin-top:100px; margin-left:15px;">
<div class="sidenav">
   
 <a href="#about" data-toggle="sidebar" data-target="#categorylist" class="dropdown-btn collapsible-header active maintype">Category <i class="fas fa-caret-down"></i></a>
        <div  class="dropdown-container" id="categorylist" style="display: block;">
            <ul>
                <?php
                             if (count($parentCategory_arr) != 0) { 
                        
                            for ($a = 0; $a < count($parentCategory_arr); $a++) {
                                // parent category list showing
                                // $cityName= $parentCategory_arr[$a][1];
                                $identifier=$a;
                                echo '
                                <a href="#" class="dropdown-btn collapsible-header childlink" data-toggle="sidebar" data-target=".subcategorylist'. $identifier.'">'.$parentCategory_arr[$a][1].'<i class="fas fa-caret-down"></i></a>
                                ';
                                $subCategory_sql="SELECT `categoryID`, `categoryName` FROM `category` WHERE `parentCategoryID` =".$parentCategory_arr[$a][0]."";
                                $subCategory_res = mysqli_query($conn, $subCategory_sql);
                                if ($subCategory_res != "") {
                                    $subCategory_arr = mysqli_fetch_all($subCategory_res);
                                } else {
                                    alert("sub category result empty");
                                }
                                echo '<div class="dropdown-container" class="subcategorylist'. $identifier.'">
                                
                                         <ul>';
                                for ($b = 0; $b < count($subCategory_arr); $b++) {
                                                echo '<form  method="POST" action="categorysearch.php">';
                                                echo '<input type="hidden" name="searchcategoryID" value="'.$subCategory_arr[$b][0].'"></input>
                                                    <input type="hidden" name="searchcategoryName" value="'.$subCategory_arr[$b][1].'"></input>
                                                ';

                                                echo '<li class="contentsli"><button type="submit">'.$subCategory_arr[$b][1].'</button></li>';
                                            
                                                echo '</form>';
                                };
                                         echo '</ul>
                                         
                                         </div>';
                               
                            }
                
                        } else {
                        
                        };

                  ?>

            </ul>
      </div>

 
  
  <li><a class="maintype" href="#services">Brand</a></li>
  <li><a class="maintype" href="#clients">On Sale</a></li>
  <a data-toggle="sidebar" data-target="#pricelist" class="dropdown-btn collapsible-header maintype">Price <i class="fas fa-caret-down"></i></a>
        <div  class="dropdown-container" id="pricelist">
                    <ul>
                    <li class="childlink" >
                    <form  method="POST" action="categorysearch.php">
                        <input type="hidden" name="searchstart" class="startnumber" value="0"></input>
                        <input type="hidden" name="searchend" class="endnumber" value="10"></input>
                    <button class="pricetrigger" type="submit" data-target="pricesearch" onclick="priceselect()">-NZ$10</button>
                    </form>
                </li>
                    <li class="childlink"><a href="#">NZ$10-NZ$15</a></li>
                    <li class="childlink"><a href="#">NZ$15-NZ$20</a></li>
                    <li class="childlink"><a href="#">NZ$20-</a></li>
                  </ul>
            </div>

    
</div>

<style>
body {
    font-family: Montserrat, sans-serif;
    
}
.dropdown-container{
    display: none;
}
.sidenav {
  text-align:center;
  width: 220px; 
  margin-top: 50px;
  margin-left: 80px;
  overflow-x: hidden;
  padding: 8px 0;
}

.maintype{
  padding: 6px 8px 6px 16px;
  font-size: 17px;
  font-weight: 700;
  color: black;
  display: block;
  border-top: 1px solid rgba(144, 180, 148, 1);
  text-align:center;
}

.childlink{
  font-size: 15px!important;
  border:none;
  color: black;
  padding: 6px 8px 6px 16px;
  /* text-decoration: none; */
  display: block;
  font-weight: 600;
  text-align:center;
  margin: 0;
  line-height:0.5;

}
.childlink a{
  font-size: 15px!important;
  color: black;
  padding: 6px 8px 6px 16px;
  /* text-decoration: none; */
  display: block;
  font-weight: 600;
  text-align:center;
  margin:0;
}
.sidenav a:hover {
  color: #064579;
  background-color: #eee;
}
li{
    list-style-type: none;
    text-align: left;
}
.contentsli button{
    background-color: transparent;
    border: none;
    text-align: left;
    font-size: 13px;
    margin-left: 40%;
    font-weight: 600;
}
li button:hover{
    color: #8B0000;
}


@media screen and (max-height: 600px) {
  .sidenav {
      width: 90%;
      margin-left: 18px;
  }
}
</style>


<script>
/* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
  this.classList.toggle("active");
  var dropdownContent = this.nextElementSibling;
  if (dropdownContent.style.display === "block") {
  dropdownContent.style.display = "none";
  } else {
  dropdownContent.style.display = "block";
  }
  });
}
</script>