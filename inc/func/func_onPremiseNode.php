<?php 
    include './func_db.php';

    if(isset($_POST['addOlt'])){
        addOLT($_POST['olt-pon'], $_POST['olt-desc'], $_POST['olt-coords']);
    }

    function addOLT($pon, $desc, $coords){
        $oltID = uniqid('olt');
        $conxn = openDB();
        $sql = "INSERT INTO `tbl_olts` (`olt_id`,`olt_pon-ports`,`olt_desc`,`olt_coordinates`)
                VALUES ('$oltID', $pon, '$desc', '$coords')";
        $rx = mysqli_query($conxn, $sql);
        mysqli_close($conxn);

        if($rx){
            header("location: ./../../cmsofc.php?olt=1");
        }
        else {
            echo $rx;
        }
    }