
<form class="add_JuncBox_Form" action="./inc/func/func_updateJBTbl.php" method="POST" class="p-5">
    <h2>Junction Box Installation</h2>
    <select name="poleID" id="" class="form-control mb-2">
        <?php
            $poles = getPoles();

            while($row = mysqli_fetch_assoc($poles)) { 
        ?>
            <option value="<?php echo $row['pole_id'];?>"><?php echo $row['pole_zone'].'-'.$row['pole_id'];?></option>
        <?php } ?>
    </select>
    <input type="text" name="jb_desc" class="form-control mb-2" id="pole-lat" placeholder="Enter Description">
    <input type="submit" name="submit" class="btn btn-primary">
</form>

<style>
    .add_JuncBox_Form {
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
    let addJBVw = false
    function addJB(){
        if(addJBVw==false){
            $('.add_JuncBox_Form').css('display', 'block')
            addJBVw = true
        }
        else {
            $('.add_JuncBox_Form').css('display', 'none')
            addJBVw = false
        }
    }
</script>