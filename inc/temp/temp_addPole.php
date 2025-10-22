<form class="add_Pole_Form" action="./inc/func/func_updatePoleTbl.php" method="POST" class="p-5">
    <h2>Pole Installation</h2>
    <input type="text" name="coordx" class="form-control mb-2" id="pole-lat" placeholder="Enter Pole Latitude">
    <input type="text" name="coordy" class="form-control mb-2" id="pole-lng" placeholder="Enter Pole Longitude">
    <input type="text" name="zone" class="form-control mb-2" placeholder="Enter Zone">
    <input type="submit" name="submit" class="btn btn-primary">
</form>

<style>
    .add_Pole_Form {
        display: none;

        width: 450px;
        padding: 2rem;

        background-color: orange;
        border-radius: 1rem;

        position: absolute;
        top: 3rem;
        left: 3rem;

        z-index: 9999;
    }
</style>

<script defer>
    let addPoleVw = false
    function addPole(){
        if(addPoleVw==false){
            $('.add_Pole_Form').css('display', 'block')
            addPoleVw = true
            $('.add_JuncBox_Form').css('display', 'none')
            addJBVw = false
        }
        else {
            $('.add_Pole_Form').css('display', 'none')
            addPoleVw = false
        }
    }
</script>