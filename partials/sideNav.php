<?php
include_once('connection.php');
$parentCategory_sql = "SELECT `categoryID`, `categoryName` FROM `category` WHERE `parentCategoryID` IS NULL";
$parentCategory_res = mysqli_query($connection, $parentCategory_sql);
if ($parentCategory_res != "") {
  $parentCategory_arr = mysqli_fetch_all($parentCategory_res);
} else {
  alert(" parent category result empty");
}
?>
<div class="sidenav m-0" style="width: 100%; height: 100%; background-color: rgba(224, 184, 65, 1);">
  <a href="#about" data-toggle="sidebar" data-target="#categorylist" class="dropdown-btn collapsible-header active maintype">Category <i class="fas fa-caret-down"></i></a>
  <div class="dropdown-container" id="categorylist" style="display: block;">
    <ul>
      <?php
      if (count($parentCategory_arr) != 0) {
        for ($a = 0; $a < count($parentCategory_arr); $a++) {
          // parent category list showing
          // $cityName= $parentCategory_arr[$a][1];
          $identifier = $a;
          echo '
                        <a class="dropdown-btn collapsible-header childlink" data-toggle="sidebar" data-target=".subcategorylist' . $identifier . '">' . $parentCategory_arr[$a][1] . ' <i class="fa fa-angle-down"></i></a>
                        ';
          $subCategory_sql = "SELECT `categoryID`, `categoryName` FROM `category` WHERE `parentCategoryID` =" . $parentCategory_arr[$a][0] . "";
          $subCategory_res = mysqli_query($connection, $subCategory_sql);
          if ($subCategory_res != "") {
            $subCategory_arr = mysqli_fetch_all($subCategory_res);
          } else {
            alert("sub category result empty");
          }
          echo '<div class="dropdown-container" class="subcategorylist' . $identifier . '">
                                 <ul>';
          for ($b = 0; $b < count($subCategory_arr); $b++) {
            $categoryInfo = array(
              'searchPara' => "?searchcategoryID=" . $subCategory_arr[$b][0] . "&searchcategoryName=" . $subCategory_arr[$b][1] . "&location=category",
              'location' => "category"
            );
            // var_dump($productInfo);
            $categoryInfoJson = json_encode($categoryInfo);
            // var_dump($productInfoJson);
            echo '<li class="contentsli">
                                      <button type="button" class="linkanchor" value=' . $categoryInfoJson . ' onclick="showProduct(this.value)" >' . $subCategory_arr[$b][1] . '</button>
                                  </li>';
          };
          echo '</ul>
                            </div>';
        }
      }

      ?>

    </ul>
  </div>

  <?php
  $brandInfo = array(
    'searchPara' => '?location=brandlist',
    'location' => 'brandlist'
  );
  $brandInfoJson = json_encode($brandInfo);
  $onSale = array(
    'searchPara' => '?location=salelist&opt=all',
    'location' => 'salelist'
  );
  $onSaleJson = json_encode($onSale);
  ?>
  <li><button class="maintype" value='<?php echo $brandInfoJson ?>' onclick="showProduct(this.value)">Brand</button></li>
  <li><button class="maintype" value='<?php echo $onSaleJson ?>' onclick="showProduct(this.value)">On Sale</button></li>
  <a data-toggle="sidebar" href="#" data-target="#pricelist" class="dropdown-btn collapsible-header maintype" id="pricebutton">Price <i class="fas fa-caret-down"></i></a>
  <div class="dropdown-container" id="pricelist">
    <ul>
      <?php
      $i = 0;
      while ($i <= 35) {
        // var_dump($i);
        $priceJson = array(
          'searchPara' => '',
          'location' => 'priceRange'
        );
        echo '
                      <li class="childlink">';
        if ($i == 35) {
          $priceJson['searchPara'] = 'partials' . DIRECTORY_SEPARATOR . 'discountrate.php?searchstart=' . $i . '&location=priceRange';
          echo '
                          <a class="childprice"><button value=' . json_encode($priceJson) . ' class="pricetrigger" type="button" onclick="showProductAjax(this.value)">NZ$' . $i . '-</button></a>
                      </li>
                      ';
        } else {
          $priceJson['searchPara'] = 'partials' . DIRECTORY_SEPARATOR . 'discountrate.php?searchstart=' . $i . '&searchend=' . ($i + 5) . '&location=priceRange';
          echo '
                          <a class="childprice"><button value=' . json_encode($priceJson) . ' class="pricetrigger" type="button" onclick="showProductAjax(this.value)">NZ$' . $i . '-NZ$' . ($i + 5) . '</button></a>
                      </li>
                      ';
        }
        $i = ($i + 5);
        // var_dump($i);
      }
      ?>
    </ul>
  </div>
</div>

<style>
  body {
    font-family: Montserrat, sans-serif;

  }

  .dropdown-container {
    display: none;
  }

  .sidenav {
    text-align: center;
    width: 100%;
    margin: auto;
    overflow-x: hidden;
  }

  .maintype {
    width: 100%;
    padding: 6px 8px 6px 16px;
    font-size: 17px;
    font-weight: 700;
    color: black;
    display: block;
    border-top: 1px solid rgba(144, 180, 148, 1);
    border: none;
    text-align: center;
    background-color: rgba(224, 184, 65, 1);
  }

  .childlink {
    font-size: 15px !important;
    border: none;
    color: black;
    padding: 6px 8px 6px 16px;
    /* text-decoration: none; */
    display: block;
    font-weight: 600;
    text-align: center;
    margin: 0;
    line-height: 0.5;

  }

  .childlink a {
    font-size: 15px !important;
    color: black;
    padding: 6px 8px 6px 16px;
    /* text-decoration: none; */
    display: block;
    font-weight: 600;
    text-align: center;
    margin: 0;
  }

  .sidenav a:hover,
  .sidenav a:focus {
    color: #064579;
    background-color: #eee;
    cursor: pointer;
  }

  .maintype:active {
    color: #064579;
    background-color: #eee !important;
  }

  .maintype:focus {
    color: #064579;
    background-color: #eee !important;
  }

  .maintype:hover {
    color: #064579;
    background-color: #eee !important;
    text-decoration: none;
  }

  li {
    list-style-type: none;
    text-align: left;
  }

  .linkanchor {
    background-color: transparent;
    border: none;
    text-align: left;
    font-size: 13px;
    margin-left: 40%;
    font-weight: 600;
  }

  .linkanchor:hover {
    color: #8B0000 !important;
  }

  button.pricetrigger {
    background-color: transparent;
    border: none;
    text-align: left;
    font-size: 14px;
    /* margin-left: 20%; */
    font-weight: 600;
  }

  button.pricetrigger:hover,
  button.pricetrigger:focus {
    color: #064579;
    background-color: #eee;
  }

  @media screen and (max-height: 600px) {
    .sidenav {
      width: 90%;
      margin-left: 18px;
    }
  }

  .linkanchor {
    color: black !important;
  }

  .linkanchor:hover,
  .linkanchor:active {
    color: black !important;
    text-decoration: none;
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