<form class="add_Spltr_Form" action="./inc/func/func_updateJBTbl.php" method="POST" class="p-5">
    <h6>Splitter Installation</h6>
    <div class="form-floating mb-2">
        <select name="jbID" id="jb-id" class="form-control">
            <?php
                $jbs = getJBs();
        
                while($row = mysqli_fetch_assoc($jbs)) { 
            ?>
                <option value="<?php echo $row['jb_id'];?>"><?php echo 'JB'.$row['jb_id'].'-P'.$row['pole_id'];?></option>
            <?php } ?>
        </select>
        <label for="jb-id">Junction Box ID</label>
    </div>
    <div class="form-floating mb-2">
        <input type="text" name="spltr-ratio" class="form-control" id="spltr-ratio" placeholder="Splitter Ratio">
        <label for="spltr-ratio">Splitter Ratio</label>
    </div>
    <div class="form-floating mb-2">
        <input type="text" name="spltr-tray" class="form-control" id="spltr-tray" placeholder="Splitter Tray">
        <label for="spltr-tray">Tray No.</label>
    </div>
    <div class="form-floating mb-2">
        <input type="text" name="spltr-desc" class="form-control" id="spltr-tray" placeholder="Splitter Description">
        <label for="spltr-desc">Splitter Description</label>
    </div>

    <input type="submit" name="addSpltr" class="btn btn-primary">
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
    function addSpltr(){
        if(addSpltrVw==false){
            $('.add_Spltr_Form').css('display', 'block')
            addSpltrVw = true

            $('.add_Pole_Form').css('display', 'none')
            addPoleVw = false
            $('.add_JuncBox_Form').css('display', 'none')
            addJBVw = false
        }
        else {
            $('.add_Spltr_Form').css('display', 'none')
            addSpltrVw = false
        }
    }
</script>