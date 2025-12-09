<form class="add_Spltr_Form" action="./inc/func/func_updateJBTbl.php" method="POST" class="p-5">
    <h6>Splitter Installation</h6>
    <div class="form-floating mb-2">
        <input type="text" name="jbID" class="form-control" id="jb-id" placeholder="JB ID" required>
        <label for="jb-id">Junction Box ID</label>
    </div>
    <div class="form-floating mb-2">
        <input type="text" name="spltr-ratio" class="form-control" id="spltr-ratio" placeholder="Splitter Ratio" required>
        <label for="spltr-ratio">Splitter Ratio</label>
    </div>
    <div class="form-floating mb-2">
        <input type="text" name="spltr-tray" class="form-control" id="spltr-tray" placeholder="Splitter Tray" required>
        <label for="spltr-tray">Tray No.</label>
    </div>
    <div class="form-floating mb-2">
        <input type="text" name="spltr-desc" class="form-control" id="spltr-desc" placeholder="Splitter Description" required>
        <label for="spltr-desc">Splitter Description</label>
    </div>

    <input type="submit" name="addSpltr" class="btn btn-primary">
    <input type="button" value="Close" class="btn btn-warning" onclick="addSpltrs()">
</form>

<style>
    .add_Spltr_Form {
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
    let addSpltrVw = false
    function addSpltrs(jbId){
        if(addSpltrVw==false){
            $('.add_Spltr_Form').css('display', 'block')
            addSpltrVw = true
            $('.add_Pole_Form').css('display', 'none')
            addPoleVw = false
            $('.add_JuncBox_Form').css('display', 'none')
            addJBVw = false
            $('.add_OLT_Form').css('display', 'none')
            addOLTVw = false

            $('#jb-id').val(jbId)
        }
        else {
            $('.add_Spltr_Form').css('display', 'none')
            addSpltrVw = false
        }
    }
</script>