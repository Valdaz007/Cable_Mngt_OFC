<?php
    include './inc/func/func_db.php';

    function getPoles(){
        $sql = "SELECT * FROM `tbl_poles`;";
        $conxn = openDB();

        $rx = mysqli_query($conxn, $sql);
        mysqli_close($conxn);

        if(mysqli_num_rows($rx) > 0){
            return mysqli_fetch_all($rx);
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

    <header>
        <div class="header_Cont">
            <h1>CABLE MANAGEMENT</h1>
            <button class="btn btn-sm btn-warning" onclick="addPole()">Add Pole</button>
        </div>
    </header>

    <main>
        <div id="mapCont">
        </div>

        <?php include './inc/temp/temp_addPole.php'; ?>
    </main>

    <input id="polesData" type="hidden" style="display:none;" data-poles='<?php echo json_encode(getPoles()); ?>'>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
</body>
</html>

<style>
    body {
        width: 100%;
        box-sizing: border-box;
    }

    header {
        width: 100%;
        height: 65px;

        padding: .8rem;

        background-color: dodgerblue;

        .header_Cont {
            width: 95%;
            margin: 0 auto;
            height: 100%;

            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .header_Cont h1 {
            color: white;
            font-size: 1.6rem;
        }
    }

    main {
        width: 100%;
        height: calc(100vh - 65px);

        position: relative;
    }

    #mapCont {
        width: 100%;
        height: 100%;
    }
</style>

<script src="./inc/js/jquery-3.7.1.min.js"></script>
<script>
    let mapOptions = {
        center: [-9.45142, 147.19585],
        zoom: 14
    }

    let map = new L.map('mapCont', mapOptions)
    let layer = new L.TileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png')
    map.addLayer(layer)


    //? Pull In Pole Coordinates & Add Marker to Map

    let poles = $('#polesData').attr('data-poles')
    poles = JSON.parse(poles)

    poles.forEach((i, idx)=>{
        temp = new L.Marker([parseFloat(i[1]), parseFloat(i[2])])
        temp.addTo(map)
    })

    //? Event to trigger when a location on map is clicked
    map.on('click', (event)=>{
        $('#pole-lat').val(event.latlng.lat.toFixed(5))
        $('#pole-lng').val(event.latlng.lng.toFixed(5))
    })
</script>