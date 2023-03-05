<?php
    class dbconnect {
        public static function connectDb() {
            $link = mysqli_connect("localhost","root","","webdev");

           /* if (!$link) {
                die("Connection failed: " . mysqli_connect_error());
              }
              echo "Connected successfully";*/
    }

        
    }
?>