<?php

    function openDB(){
        
        $config = parse_ini_file(__DIR__ . "/config.ini", true); // Sensitive DB Info

        $conn = mysqli_connect($config["database"]["hostname"], 
                                $config["database"]["username"], 
                                $config["database"]["password"], 
                                $config["database"]["database"]);
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        return $conn;
    }