<?php
    class Conn {
        public static function getConn() {
            
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "liquorlibrary";
            
            if (isset($_ENV['DATABASE_CONNECTION_URL'])) {
                $servername = $_ENV['DATABASE_CONNECTION_URL'];
            }
            if (isset($_ENV['DATABASE_NAME'])) {
                $dbname = $_ENV['DATABASE_NAME'];
            }
            if (isset($_ENV['DATABASE_USERNAME'])) {
                $dbname = $_ENV['DATABASE_USERNAME'];
            }
            if (isset($_ENV['DATABASE_PASSWORD'])) {
                $dbname = $_ENV['DATABASE_PASSWORD'];
            }
            // Create connection
            $conn = mysqli_connect($servername, $username, $password, $dbname);
            
            return $conn;
        }
    }