<div class="poleView" id="poleVw">
    <div class="backBtn">
        <button class="btn btn-sm btn-warning" style="text-decoration: none;" onclick="closePoleVw()"><span>>></span>Close</button>
        <button class="btn btn-sm btn-warning" onclick="addJB()">Add Enclosure</button>
    </div>
    <div class="subHead">
        
        <input type="hidden" id="poleData" data-pole="">
        
        <div>
            <div class="form-floating">
                <input type="text" class="form-control" id="poleID" value="" disabled>
                <label for="poleID">Node ID</label>
            </div>
            <div class="form-floating">
                <input type="text" class="form-control" id="poleZone" value="" disabled>
                <label for="poleZone">Node Zone / PON No.</label>
            </div>
            <div class="form-floating">
                <input type="text" class="form-control" id="poleCoords" value="" disabled>
                <label for="poleCoords">Coordinates</label>
            </div>
        </div>

        <div class="delbtn">
            <input type="hidden" name="poleID" id="delPoleId" value="">
            <button class="btn btn-danger" style="width: 150px;" onclick="delPole()">Delete</button>
        </div>
    </div>
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
        display: flex;
        justify-content: space-between;
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

<script defer>
    poleVw = false
    function closePoleVw(){
        $('.poleView').css('transform', 'translateX(400px)')
        poleVw = false
    }

    function delPole(){
        markerId = $('#delPoleId').val()
        $.ajax({
            type: 'POST',
            url: './inc/func/func_updatePoleTbl.php',
            data: {
                subDelID: markerId
            },
            cache: false,
            success: function(data){
                console.log(data)
                if(data){
                    markers[markerId].remove(map)
                }
            },
            error: (xhr, status, error)=>{ console.log(xhr) }
        })
    }
</script>