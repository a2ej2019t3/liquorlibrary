<?php
    class Conn {
        public static function getConn() {
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "liquorlibrary";
    
            // Create connection
            $conn = mysqli_connect($servername, $username, $password, $dbname);
            
            return $conn;
        }
    }