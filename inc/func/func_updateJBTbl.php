<?php
    include './func_db.php';

    if(isset($_POST['submit'])){  //? Add Junction Box
        $conxn = openDB();
        $sql = "INSERT INTO `tbl_junction-boxes` (`jb_id`, `jb_desc`, `pole_id`)
                VALUES (NULL, '".$_POST['jb_desc']."', '".$_POST['poleID']."')";

        $rx = mysqli_query($conxn, $sql);

        if($rx){
            $sql = "UPDATE `tbl_poles` SET `pole_jb` = '1' WHERE `tbl_poles`.`pole_id` = '".$_POST['poleID']."'";
            mysqli_query($conxn, $sql);
            mysqli_close($conxn);

            header("location: ./../../cmsofc.php?jb=true"); 
        }
        else {
            echo $rx;
        }
    }
    if(isset($_POST['delJB'])){
        if(delJunctionBox($_POST['delJB'])==1){
            echo '{"delJb":1}';
        }
        else {
            echo '{"delJB":0}';
        }
        exit();
    }
    if(isset($_POST['getJBs'])){
        echo getJunctionBoxes();
        exit();
    }
    if(isset($_POST['getPoleJbs'])){
        echo getPole_JunctionBoxesCount($_POST['getPoleJbs']);
        exit();
    }

    //? ADD SPLITTER TO DB
    if(isset($_POST['addSpltr'])){
        addSpltr($_POST['spltr-ratio'], $_POST['spltr-tray'], $_POST['spltr-desc'], $_POST['jbID']);
    }

    if(isset($_POST['getSpltr'])){
        getJBSpltr($_POST['getSpltr']);
        exit();
    }

    function delJunctionBox($jbId){
        $conxn = openDB();
        $sql = "DELETE FROM `tbl_junction-boxes` WHERE `jb_id` = $jbId;";

        $rx = mysqli_query($conxn, $sql);
        mysqli_close($conxn);

        return $rx;
    }

    //*** GET ALL JUNCTION BOXES
    function getJunctionBoxes(){
        $sql = "SELECT * FROM `tbl_junction-boxes`;";

        $conxn = openDB();

        $rx = mysqli_query($conxn, $sql);
        mysqli_close($conxn);

        if(mysqli_num_rows($rx) > 0){
            return json_encode(mysqli_fetch_all($rx));
        }
        else {
            return 0;
        }
    }

    //*** GET JUNCTION BOXES ON SPECIFIED POLE
    function getPole_JunctionBoxesCount($poleId){
        $sql = "SELECT * FROM `tbl_junction-boxes` WHERE `pole_id`=$poleId;";

        $conxn = openDB();

        $rx = mysqli_query($conxn, $sql);
        mysqli_close($conxn);

        return mysqli_num_rows($rx);
    }

    function addSpltr($ratio, $tray, $desc, $jbID){
        $conxn = openDB();
        $spltrID = uniqid('spl');
        $sql = "INSERT INTO `tbl_splitter` (`spltr_id`, `spltr_ratio`, `spltr_tray`, `spltr_desc`, `jb_id`)
                VALUES('$spltrID', '$ratio', '$tray', '$desc', $jbID)";
        $rx = mysqli_query($conxn, $sql);
        mysqli_close($conxn);

        if($rx){
            header("location: ./../../cmsofc.php?spltr=1");
        }
        else {
            echo $rx;
        }
    }

    function getJBSpltr($jbId){
        $conn = openDB();
        $sql = "SELECT * FROM `tbl_splitter` WHERE `jb_id`=$jbId;";
        $rx = mysqli_query($conn, $sql);
        mysqli_close($conn);
        if(mysqli_num_rows($rx)>0){
            echo json_encode(mysqli_fetch_all($rx));
        }
        else {
            echo false;
        }
    }