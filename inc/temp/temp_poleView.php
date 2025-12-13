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
            <button class="btn btn-sm btn-danger" style="width: 150px;" onclick="delPole()">Delete Pole</button>
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
            width: 300px;
        }

        .delJBBtn {
            background: none;
            border: none;
            width: 35px;

            & img {
                aspect-ratio: 1;
                height: 30px;
            }
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
        if(confirm('Are You Sure You Want To Delete Pole!')){
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

    function poleVwJBs(poleId){
        jbs = JSON.parse($('#jbsData').attr('data-jbs'))
        $('.jbCont').append('<h5>Junction Box</h5><table class="table jbTblLs"></table>')
        jbs.forEach((i, idx)=>{
            if(i[2]==poleId){
                $('.jbTblLs').append(
                `<tr class='jbTblRw' id='jbTblRwId-${i[0]}'>
                    <td>
                        <button class='jb${i[0]} btn btn-sm btn-primary' onclick='openJBVw(${i[0]})'>${i[1]}</button>
                    </td>
                    <td>
                        <button class='delJBBtn' onclick='delJBs(${i[0]})'><img src='./inc/img/delBtn.png'></button>
                    </td>
                </tr>`
                )
            }
        })
    }

    async function delJBs(delJbId){
        if(confirm('Are You Sure You Want To Delete Junction Box?')){
            let rx = await delJuncBox(delJbId)
            console.log(rx)
            rx = await updateJBs()
            console.log(rx)
            $('.jbCont').empty()
            if(rx>0) { poleVwJBs($('#delPoleId').val()) }
            if(rx==0) { updatePoleJB($('#delPoleId').val(), 0) }
        }
    }

    function delJuncBox(delJbId){
        return new Promise((resolve, reject) => {
            $.ajax({
                type: 'POST',
                url: './inc/func/func_updateJBTbl.php',
                data: { delJB: delJbId },
                cache: false,
                success: function(data){
                    data = JSON.parse(data)
                    if(data['delJb']==1){
                        resolve('JB RMVD 4RM DB!')
                    }
                    else {
                        reject(data)
                    }
                },
                error: (xhr,status,error)=>{ console.log(xhr) }
            })
        })
    }

    function updateJBs(){
        return new Promise((resolve, reject)=>{
            $.ajax({
                type: 'POST',
                url: './inc/func/func_updateJBTbl.php',
                data: { getJBs: true },
                cache: false,
                success: function(data){
                    if(data==0){
                        reject('Update Attr Error!')
                    } 
                    else {
                        $('#jbsData').attr('data-jbs', `${data}`)
                        data = JSON.parse(data)
                        console.log(data)
                        poleJbCount = 0
                        data.forEach((i)=>{
                            if(i[2]==$('#delPoleId').val()){ poleJbCount++ }
                        })
                        resolve(poleJbCount)
                    }
                },
                error: (xhr,status,error)=>{ console.log(xhr) }
            })
        })
    }

    function checkJbs(){
        return new Promise((resolve, reject)=>{
            $.ajax({
                type: 'POST',
                url: './inc/func/func_updateJBTbl.php',
                data: { getPoleJbs: true },
                cache: false,
                success: function(data){
                    if(data==0){
                        resolve(0)
                    }
                    else {
                        reject(1)
                    }
                },
                error: (xhr,status,error)=>{ console.log(xhr) }
            })
        })
    }

    function updatePoleJB(pid, value){
        $.ajax({
            type: 'POST',
            url: './inc/func/func_updatePoleTbl.php',
            data: {updatePoleJB:pid, value:value},
            cache: false,
            success: function(data){
                console.log(data)
            },
            error:(error,status,xhr)=>{console.log(xhr)}
        })
    }
</script>