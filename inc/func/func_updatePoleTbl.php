<?php
    include './func_db.php';

    if(isset($_POST['subAddPole'])){
        addPole($_POST['lat'], $_POST['lng'], $_POST['zon']);
    }
    elseif(isset($_POST['subDelID'])) {
        delPole($_POST['subDelID']);
    }
    elseif(isset($_POST['getPole'])){
        getPole();
    }
    elseif(isset($_POST['getPolesData'])){
        echo getPoles();
    }

    function delPole($id){
        $conxn = openDB();
        $sql = "DELETE FROM `tbl_poles` WHERE `pole_id` = $id";

        $rx = mysqli_query($conxn, $sql);
        mysqli_close($conxn);

        echo $rx;
    }

    function addPole($lat, $lng, $zon){
        $conxn = openDB();
        $sql = "INSERT INTO `tbl_poles` (`pole_id`, `pole_latitude`, `pole_longitude`, `pole_zone`)
                VALUES (NULL, '$lat', '$lng', '$zon')";

        $rx = mysqli_query($conxn, $sql);
        mysqli_close($conxn);

        echo $rx;
    }

    function getPole(){
        $conxn = openDB();
        $sql = "SELECT * FROM `tbl_poles` ORDER BY `pole_id` DESC LIMIT 1";

        $rx = mysqli_query($conxn, $sql);
        mysqli_close($conxn);

        if(mysqli_num_rows($rx) == 1){
            echo json_encode(mysqli_fetch_assoc($rx));
        }
        else {
            echo '!Error: ' . $rx;
        }
    }
    
    function getPoles(){
        $sql = "SELECT * FROM `tbl_poles`;";
        $conxn = openDB();

        $rx = mysqli_query($conxn, $sql);
        mysqli_close($conxn);

        if(mysqli_num_rows($rx) > 0){
            return json_encode(mysqli_fetch_all($rx));
        }
        else {
            return false;
        }
    }