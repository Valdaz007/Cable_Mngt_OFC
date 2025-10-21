<div class="poleView">
    <form action="./inc/func/func_updatePoleTbl.php" method="POST" class="subHead">
        <h4>Pole ID: <?php echo $_POST['poleId']; ?></h4>
        <input type="hidden" name="poleID" value="<?php echo $_POST['poleId']; ?>">
        <input type="submit" name="subDelID" class="btn btn-sm btn-danger" value="Delete"/>
    </form>
</div>

<style>
    .poleView {
        padding: 1rem;
    }

    .poleView .subHead {
        display: flex;
        justify-content: space-between;
    }
</style>