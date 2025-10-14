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
    <form action="./inc/func/func_updatePoleTbl.php" method="POST" class="p-5">
        <h2>Pole Installation</h2>
        <input type="text" name="coordx" class="form-control mb-2" placeholder="Enter Pole Latitude">
        <input type="text" name="coordy" class="form-control mb-2" placeholder="Enter Pole Longitude">
        <input type="text" name="zone" class="form-control mb-2" placeholder="Enter Zone">
        <input type="submit" name="submit" class="btn btn-primary">
    </form>

    <div id="mapCont">
    </div>

    <input id="polesData" type="hidden" style="display:none;" data-poles='<?php echo json_encode(getPoles()); ?>'>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
</body>
</html>

<style>
    #mapCont {
        width: 90%;
        margin: 0 auto;
        margin-bottom: 3rem;
        aspect-ratio: 2/1;
    }
</style>

<script src="./inc/js/jquery-3.7.1.min.js"></script>
<script>
    let mapOptions = {
        center: [-9.45142, 147.19585],
        zoom: 13
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
</script>