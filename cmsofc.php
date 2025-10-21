<?php
    include './inc/func/func_db.php';

    function getPoles(){
        $sql = "SELECT * FROM `tbl_poles`;";
        $conxn = openDB();

        $rx = mysqli_query($conxn, $sql);
        mysqli_close($conxn);

        if(mysqli_num_rows($rx) > 0){
            return $rx;
        }
        else {
            return 'Error';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./inc/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <title>Add Pole Installation</title>
</head>
<body>
    <?php include './inc/temp/temp_header.php'; ?>

    <main>
        <div id="mapCont">
        </div>

        <?php include './inc/temp/temp_sideMenuBar.php'; ?>

        <?php include './inc/temp/temp_addPole.php'; ?>
        <?php include './inc/temp/temp_addJuncBox.php'; ?>
    </main>

    <input id="polesData" type="hidden" style="display:none;" data-poles='<?php echo json_encode(mysqli_fetch_all(getPoles())); ?>'>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <style>
        body {
            width: 100%;
            box-sizing: border-box;
        }

        main {
            width: 100%;
            height: calc(100vh - 65px);

            position: relative;
            display: flex;

            #polePopup {
                & p {
                    margin: 0;
                    padding: 0;
                }
            }
        }

        #mapCont {
            width: 100%;
            height: 100%;
        }
    </style>

    <script src="./inc/js/jquery-3.7.1.min.js"></script>
    <script src="./inc/js/func_mapPoles.js"></script>
</body>
</html>