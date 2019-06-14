<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
<style> 

.processmsg{
    font-size: 2rem;
    font-weight: 700;
}
.lds-hourglass {
  display: none;
  position: absolute;
  top: 39%;
  left: 39%;
  width:400px;
  height: 64px;
  text-align: center;
}
.lds-hourglass:after {
  content: " ";
  display: block;
  border-radius: 50%;
  width: 0;
  height: 0;
  text-align: center;
  margin: 10px auto!important;
  margin: 6px;
  box-sizing: border-box;
  border: 26px solid #fdd;
  border-color: #fdd transparent #fdd transparent;
  animation: lds-hourglass 1.2s infinite;
}
@keyframes lds-hourglass {
  0% {
    transform: rotate(0);
    animation-timing-function: cubic-bezier(0.55, 0.055, 0.675, 0.19);
  }
  50% {
    transform: rotate(900deg);
    animation-timing-function: cubic-bezier(0.215, 0.61, 0.355, 1);
  }
  100% {
    transform: rotate(1800deg);
  }
}
</style>

</head>
<body>
<button type="button" onclick="loader5();">Button</button>

<div id="loader5" class="lds-hourglass"> <span class="processmsg">Processing your order</span></div>


<?php
    include_once ("partials/foot.php");
    ?>  
  <script type="text/javascript" src="js/sub.js"></script>
  <script type="text/javascript" src="js/main.js"></script>
  <script type="text/javascript" src="js/search.js"></script>
  <script type="text/javascript" src="js/cart.js"></script>
  <script type="text/javascript" src="js/pay.js"></script>
  <script type="text/javascript" src="https://js.stripe.com/v3/"></script>

</body>
</html>
