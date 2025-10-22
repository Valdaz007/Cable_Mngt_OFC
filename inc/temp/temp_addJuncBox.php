
<form class="add_JuncBox_Form" action="./inc/func/func_updateJBTbl.php" method="POST" class="p-5">
    <h6>Junction Box Installation</h6>
    <div class="form-floating mb-2">
        <select name="poleID" id="pole-id" class="form-control">
            <?php
                $poles = getPoles();
        
                while($row = mysqli_fetch_assoc($poles)) { 
            ?>
                <option value="<?php echo $row['pole_id'];?>"><?php echo $row['pole_zone'].'-'.$row['pole_id'];?></option>
            <?php } ?>
        </select>
        <label for="pole-id">Pole ID</label>
    </div>
    <div class="form-floating mb-2">
        <input type="text" name="jb_desc" class="form-control" id="jb-desc" placeholder="Enter Description">
        <label for="jb-desc">Pole Description</label>
    </div>

    <input type="submit" name="submit" class="btn btn-primary">
</form>

<style>
    .add_JuncBox_Form {
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
    let addJBVw = false
    function addJB(){
        if(addJBVw==false){
            $('.add_JuncBox_Form').css('display', 'block')
            addJBVw = true
            
            $('.add_Pole_Form').css('display', 'none')
            addPoleVw = false
        }
        else {
            $('.add_JuncBox_Form').css('display', 'none')
            addJBVw = false
        }
    }
</script>