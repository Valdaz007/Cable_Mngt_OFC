<form class="add_OLT_Form" action="#" method="POST" class="p-5">
    <h6>OLT Installation</h6>
    <div class="form-floating mb-2">
        <input type="text" name="spltr-ratio" class="form-control" id="spltr-ratio" placeholder="OLT PON No.">
        <label for="spltr-ratio">OLT PON No.</label>
    </div>
    <div class="form-floating mb-2">
        <input type="text" name="spltr-tray" class="form-control" id="spltr-tray" placeholder="OLT Description">
        <label for="spltr-tray">OLT Description</label>
    </div>
    <div class="form-floating">
        <input type="text" name="coordx" class="form-control mb-2" id="olt-lat" placeholder="Enter OLT Latitude">
        <label for="olt-lat">OLT Latitude</label>
    </div>
    <div class="form-floating">
        <input type="text" name="coordy" class="form-control mb-2" id="olt-lng" placeholder="Enter OLT Longitude">
        <label for="olt-lng">OLT Longitude</label>
    </div>

    <input type="submit" name="addOlt" class="btn btn-primary">
</form>

<style>
    .add_OLT_Form {
        display: none;

        width: 450px;
        padding: 1rem;

        background-color: orange;
        border-radius: 1rem;

        position: absolute;
        top: 3rem;
        left: 3rem;

        z-index: 9999;
    }
</style>

<script defer>
    let addOLTVw = false
    function addOLT(){
        if(addOLTVw==false){
            $('.add_OLT_Form').css('display', 'block')
            addOLTVw = true

            $('.add_Pole_Form').css('display', 'none')
            addPoleVw = false
            $('.add_JuncBox_Form').css('display', 'none')
            addJBVw = false
            $('.add_Spltr_Form').css('display', 'none')
            addSpltrVw = false
        }
        else {
            $('.add_OLT_Form').css('display', 'none')
            addOLTVw = false
        }
    }
</script>