<div class="poleView" id="poleVw">
    <div class="backBtn">
        <button class="btn btn-sm btn-warning" onclick="addJB()">Add Enclosure</button>
        <button class="btn btn-sm btn-warning" style="text-decoration: none;" onclick="closePoleVw()"><span>>></span>Close</button>
    </div>
    <div class="subHead">
        <input type="hidden" id="poleData" data-pole="">
        <div>
            <h5 class="nodeHead" style="font-family: oswald;"></h5>
            <div class="form-floating">
                <input type="text" class="form-control" id="poleID" value="" disabled>
                <label for="poleID">Node ID</label>
            </div>
            <div class="form-floating">
                <input type="text" class="form-control" id="poleZone" value="" disabled>
                <label for="poleZone">Node Zone / PON No.</label>
            </div>
            <div class="form-floating mb-2">
                <input type="text" class="form-control" id="poleCoords" value="" disabled>
                <label for="poleCoords">Coordinates</label>
            </div>
            <section class="jbCont"></section>
        </div>

        <div class="delbtn">
            <input type="hidden" name="poleID" id="delPoleId" value="">
            <button class="btn btn-sm btn-danger" style="width: 150px;" onclick="delPole()">Delete</button>
        </div>
    </div>
</div>

<style>
    .poleView {
        display: block;
        height: 100%;
        width: 400px;
        transform: translateX(200px);
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

    .jbCont {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;

        & h5 {
            width: 350px;
            margin: 0;
            font-family: oswald;
        }
        
        & button {
            width: calc(50% - .5rem);
        }
    }
</style>

<script defer>
    poleVw = false

    function closePoleVw(){
        $('.poleView').css('transform', 'translateX(200px)')
        poleVw = false
        closeJBVw()
    }

    function delPole(){
        if(confirm('Are You Sure You Want To Delete Junction Box!')){
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
                        closePoleVw()
                    }
                },
                error: (xhr, status, error)=>{ console.log(xhr) }
            })
        }
    }
</script>