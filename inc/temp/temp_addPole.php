<div class="add_Pole_Form" id="addPoleForm">
    <h6>Pole Installation</h6>
    <div class="form-floating">
        <input type="text" name="coordx" class="form-control mb-2" id="pole-lat" placeholder="Enter Pole Latitude">
        <label for="pole-lat">Pole Latitude</label>
    </div>
    <div class="form-floating">
        <input type="text" name="coordy" class="form-control mb-2" id="pole-lng" placeholder="Enter Pole Longitude">
        <label for="pole-lng">Pole Longitude</label>
    </div>
    <div class="form-floating">
        <input type="text" name="zone" class="form-control mb-2" id="pole-zone" placeholder="Enter Zone">
        <label for="pole-zone">Pole Zone</label>
    </div>
    <button class="btn btn-primary" onclick="addPoleDB()">Add Pole</button>
    <button class="btn btn-warning" onclick="addPole()">Close</button>
</div>

<style>
    .add_Pole_Form {
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
    let addPoleVw = false
    function addPole(){
        if(addPoleVw==false){
            $('.add_Pole_Form').css('display', 'block')
            addPoleVw = true
            
            $('.add_JuncBox_Form').css('display', 'none')
            addJBVw = false
            $('.add_Spltr_Form').css('display', 'none')
            addSpltrVw = false
            $('.add_OLT_Form').css('display', 'none')
            addOLTVw = false
        }
        else {
            $('.add_Pole_Form').css('display', 'none')
            addPoleVw = false
        }
    }

    async function addPoleDB(){
        let rx = await addPoleBE()
        rx = await getPoleBE()
    }

    function addPoleBE(){
        return new Promise((resolve, reject)=>{
            $.ajax({
                type: 'POST',
                url: './inc/func/func_updatePoleTbl.php',
                data: {
                    subAddPole: true,
                    lat: $('#pole-lat').val(),
                    lng: $('#pole-lng').val(),
                    zon: $('#pole-zone').val()
                },
                cache: false,
                success: function(data){
                    if(data){
                        resolve(data)
                    }
                    else{
                        reject('Error: '+data)
                    }
                },
                error: (xhr, status, error)=>{ console.log(xhr) }
            });
        });
    }

    function getPoleBE(){
        return new Promise((resolve, reject)=>{
            $.ajax({
                type: 'POST',
                url: './inc/func/func_updatePoleTbl.php',
                data: {
                    getPole: true
                },
                cache: false,
                success: function(data){
                    if(data){
                        data = JSON.parse(data)
                        addPole()
                        plotPole(data['pole_id'],data['pole_latitude'],data['pole_longitude'],data['pole_zone'])
                        resolve(data)
                    }
                    else{
                        reject(false)
                    }
                },
                error: (xhr, status, error)=>{ console.error(xhr); }
            });
        });
    }
</script>