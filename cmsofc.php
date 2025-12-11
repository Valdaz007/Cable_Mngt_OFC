<?php
    include './inc/func/func_db.php';

    function getJBs(){
        $sql = "SELECT * FROM `tbl_junction-boxes`;";
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

    function getOLTs(){
        $sql = "SELECT * FROM `tbl_olts`;";
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
    <title>NTT CableManagementSystemOFC</title>

    <script src="./inc/js/jquery-3.7.1.min.js"></script>
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

            overflow: hidden;

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

            position: relative;
        }
    </style>
</head>
<body>
    <?php include './inc/temp/temp_header.php'; ?>

    <main>
        <div id="mapCont">
        </div>
        <?php include './inc/temp/temp_poleView.php'; ?>
        <?php include './inc/temp/temp_JBView.php'; ?>
        <?php include './inc/temp/temp_sideMenuBar.php'; ?>

        <!-- Modals Elements -->
        <?php include './inc/temp/temp_addPole.php'; ?>
        <?php include './inc/temp/temp_addJuncBox.php'; ?>
        <?php include './inc/temp/temp_addSpltr.php'; ?>
        <?php include './inc/temp/temp_addOLT.php'; ?>
    </main>

    <input id="polesData" type="hidden" style="display:none;" data-poles>
    <input id="oltsData" type="hidden" style="display:none;" data-olts='<?php echo json_encode(mysqli_fetch_all(getOLTs())); ?>'>
    <input id="jbsData" type="hidden" style="display:none;" data-jbs='<?php echo json_encode(mysqli_fetch_all(getJBs())); ?>'>

    <script defer src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>    

    <script defer>
        //? Prevent Mouse Right Click On Map
        document.getElementById('mapCont')
        .addEventListener('contextmenu', function(event){
            event.preventDefault()
        })
    </script>
    <script defer src="./inc/js/func_map.js"></script>
    <script defer src="./inc/js/func_main.js"></script>
</body>

<script>
    function getPolesData(){
        $.ajax({
            type: 'POST',
            url: './inc/func/func_updatePoleTbl.php',
            cache: false,
            data: { getPolesData: true },
            success: function(data){
                $('#polesData').attr('data-poles', data)
            },
            error: (error, status, xhr)=>{console.log(xhr)}
        })
    }
    getPolesData()
</script>
</html>