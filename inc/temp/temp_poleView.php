<div class="poleView" id="poleVw">
    <div class="backBtn">
        <button class="btn btn-sm btn-warning" style="text-decoration: none;" onclick="closePoleVw()"><span>>></span>Close</button>
    </div>
    <form action="./inc/func/func_updatePoleTbl.php" method="POST" class="subHead">
        
        <input type="hidden" id="poleData" data-pole="">
        
        <div>
            <div class="form-floating">
                <input type="text" class="form-control" id="poleID" value="" disabled>
                <label for="poleID">Pole ID</label>
            </div>
            <div class="form-floating">
                <input type="text" class="form-control" id="poleZone" value="" disabled>
                <label for="poleZone">Pole Zone</label>
            </div>
            <div class="form-floating">
                <input type="text" class="form-control" id="poleLat" value="" disabled>
                <label for="poleLat">Pole Latitude</label>
            </div>
            <div class="form-floating">
                <input type="text" class="form-control" id="poleLng" value="" disabled>
                <label for="poleLng">Pole Longitude</label>
            </div>
            <div class="imgs">

            </div>
        </div>

        <div class="delbtn" style="">
            <input type="hidden" name="poleID" value="">
            <input type="submit" name="subDelID" class="btn btn-danger" style="width: 150px;" value="Delete"/>
        </div>
    </form>
</div>

<style>
    .poleView {
        display: block;
        height: 100%;
        width: 400px;
        transform: translateX(400px);
        padding: 1rem 1rem 2rem 1rem;

        position: absolute;
        right: 0;
        z-index: 9998;

        transition: transform 300ms ease-in-out;

        background-color: #ccc;
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
            flex-direction: column;
            gap: 1rem;

            & .form-floating {
                width: 100%;
            }
        }

        .delbtn {
            display: flex; 
            justify-content: center;
        }
    }
</style>

<script>
    function closePoleVw(){
        $('.poleView').css('transform', 'translateX(400px)')
    }
</script>