<?php
    class Conn {
        public static function getConn() {
            // $servername = "localhost";
            // $username = "root";
            // $password = "";
            // $dbname = "liquorlibrary";

            $servername = "liquorlibrary.cve0pualyi6x.ap-southeast-2.rds.amazonaws.com";
            $username = "llAdmin";
            $password = "ll1234567!";
            $dbname = "liquorlibrary";
    
            // Create connection
            $conn = mysqli_connect($servername, $username, $password, $dbname);
            
            return $conn;
        }
    }