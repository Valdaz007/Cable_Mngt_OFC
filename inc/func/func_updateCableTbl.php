<?php
include './func_db.php';

if(isset($_POST['addCable'])){
    addCable($_POST['desc'], $_POST['core'], $_POST['type'], $_POST['latlngs']);
}
elseif(isset($_POST['getCables'])){
    echo getCables();
}

function addCable($desc, $core, $type, $latlng){
    $sql = "INSERT INTO `tbl_cables` (`cable_desc`,`cable_core`,`cable_run-type`,`cable_latlng`)
            VALUES('$desc', $core, '$type', '$latlng')";
    $conxn = openDB();
    $rx = mysqli_query($conxn, $sql);
    mysqli_close($conxn);
    echo $rx;
}

function getCables(){
    $sql = "SELECT * FROM `tbl_cables`";
    $conxn = openDB();
    $rx = mysqli_query($conxn, $sql);
    mysqli_close($conxn);
    if(mysqli_num_rows($rx)>0){
        return json_encode(mysqli_fetch_all($rx));
    }
    else {
        return false;
    }
}