<div class="poleView">
    <div class="backBtn">
        <a href="./cmsofc.php" style="text-decoration: none;"><span><<</span> BACK TO MAP</a>
    </div>
    <form action="./inc/func/func_updatePoleTbl.php" method="POST" class="subHead">
        <div>
            <div class="form-floating">
                <input type="text" class="form-control" id="poleID" value="<?php echo $_POST['pole'][0]; ?>" disabled>
                <label for="poleID">Pole ID</label>
            </div>
            <div class="form-floating">
                <input type="text" class="form-control" id="poleZone" value="<?php echo $_POST['pole'][3]; ?>" disabled>
                <label for="poleZone">Pole Zone</label>
            </div>
            <div class="form-floating">
                <input type="text" class="form-control" id="poleLat" value="<?php echo $_POST['pole'][1]; ?>" disabled>
                <label for="poleLat">Pole Latitude</label>
            </div>
            <div class="form-floating">
                <input type="text" class="form-control" id="poleLng" value="<?php echo $_POST['pole'][2]; ?>" disabled>
                <label for="poleLng">Pole Longitude</label>
            </div>
            <div class="imgs">

            </div>
        </div>
        <div class="w-100" style="display: flex; justify-content: right;">
            <input type="submit" name="subDelID" class="btn btn-danger" style="width: 150px;" value="Delete"/>
        </div>
    </form>
</div>

<style>
    .poleView {
        height: 100%;
        padding: 1rem;
    }

    .poleView .backBtn {
        margin-bottom: 2rem;
    }

    .poleView .subHead {
        height: calc(100% - 3rem);
        display: flex;
        flex-direction: column;
        gap: 1rem;
        justify-content: space-between;

        & div {
            display: flex;
            gap: 1rem;

            & .form-floating {
                width: 50%;
            }
        }
    }
</style>