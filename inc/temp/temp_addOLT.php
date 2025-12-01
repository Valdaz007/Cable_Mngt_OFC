

<form class="add_OLT_Form" action="./inc/func/func_onPremiseNode.php" method="POST" class="p-5">
    <h6>OLT Installation</h6>
    <div class="form-floating mb-2">
        <input type="text" name="olt-pon" class="form-control" id="olt-pon" placeholder="OLT PON No.">
        <label for="olt-pon">OLT PON No.</label>
    </div>
    <div class="form-floating mb-2">
        <input type="text" name="olt-desc" class="form-control" id="olt-desc" placeholder="OLT Description">
        <label for="olt-desc">OLT Description</label>
    </div>
    <div class="form-floating">
        <input type="text" name="olt-coords" class="form-control mb-2" id="olt-coords" placeholder="Enter OLT Latitude">
        <label for="olt-coords">OLT Cordinates</label>
    </div>

    <input type="submit" name="addOlt" class="btn btn-primary">
    <input type="button" value="Close" class="btn btn-warning" onclick="addOLT()">
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