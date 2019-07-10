<?php
        // $servername = "localhost";
        // $username = "root";
        // $password = "";
        // $dbname = "liquorlibrary";

        $servername = "liquorlibrary.cve0pualyi6x.ap-southeast-2.rds.amazonaws.com";
        $username = "llAdmin";
        $password = "ll1234567!";
        $dbname = "liquorlibrary";

if (isset($_ENV['DATABASE_CONNECTION_URL'])) {
    $servername = $_ENV['DATABASE_CONNECTION_URL'];
}
if (isset($_ENV['DATABASE_NAME'])) {
    $dbname = $_ENV['DATABASE_NAME'];
}
if (isset($_ENV['DATABASE_USERNAME'])) {
    $username = $_ENV['DATABASE_USERNAME'];
}
if (isset($_ENV['DATABASE_PASSWORD'])) {
    $password = $_ENV['DATABASE_PASSWORD'];
}
// Create connection
$connection = mysqli_connect($servername, $username, $password, $dbname);
