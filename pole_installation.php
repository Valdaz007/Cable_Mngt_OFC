<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./inc/css/bootstrap.min.css">
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
</body>
</html>