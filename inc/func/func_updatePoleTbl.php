<?php
    echo getcwd();

    include './func_db.php';

    if(isset($_POST['submit'])){
        $conxn = openDB();
        $sql = "INSERT INTO `tbl_poles` (`pole_id`, `pole_latitude`, `pole_longitude`, `pole_zone`)
                VALUES (NULL, '".$_POST['coordx']."', '".$_POST['coordy']."', '".$_POST['zone']."')";

        $rx = mysqli_query($conxn, $sql);
        mysqli_close($conxn);

        if($rx){
            header("location: ./../../cmsofc.php?pole=true"); 
        }
        else {
            echo $rx;
        }
    }