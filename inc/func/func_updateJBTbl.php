<?php
    include './func_db.php';

    if(isset($_POST['submit'])){
        $conxn = openDB();
        $sql = "INSERT INTO `tbl_junction-boxes` (`jb_id`, `jb_desc`, `pole_id`)
                VALUES (NULL, '".$_POST['jb_desc']."', '".$_POST['poleID']."')";

        $rx = mysqli_query($conxn, $sql);
        mysqli_close($conxn);

        if($rx){
            header("location: ./../../cmsofc.php?jb=true"); 
        }
        else {
            echo $rx;
        }
    }