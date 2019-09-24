<?php
define('ROOT_DIR', dirname(__FILE__));
define('ROOT_URL', substr($_SERVER['PHP_SELF'], 0, - (strlen($_SERVER['SCRIPT_FILENAME']) - strlen(ROOT_DIR))));
// var_dump(dirname(__FILE__));
// echo '<br>';
// var_dump($_SERVER['PHP_SELF']);
// echo '<br>';
// var_dump(substr($_SERVER['PHP_SELF'], 0, - (strlen($_SERVER['SCRIPT_FILENAME']) - strlen(ROOT_DIR))));
var_dump(ROOT_DIR);
echo '<br>';
var_dump(ROOT_URL);