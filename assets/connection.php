<?php 

    class Connection{

        function connect(){
            # Database login variables:
            $username = "root";
            $password = "";
            $host = "localhost";
            $db_name = "realestate";
            
            $conn = mysqli_connect($host, $username, $password, $db_name); # Connecting to the db

            if($conn) return $conn; # If connect, return bool value True
            else throw new Exception("Couldn't connect to database."); # Else throw an exception with following message.
        }
    }



?>