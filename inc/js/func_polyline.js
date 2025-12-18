let addCableVw = false
var addCableLine = new L.polyline([], {color:'orange'}).addTo(map)
var addLineMarker = []
var lineMarkers = {}

function openCableVw(){
    if(addCableVw==false){
        $('.add_Cable_Form').css('display', 'block')
        addCableVw = true
        
        $('.add_JuncBox_Form').css('display', 'none')
        addJBVw = false
        $('.add_Spltr_Form').css('display', 'none')
        addSpltrVw = false
        $('.add_OLT_Form').css('display', 'none')
        addOLTVw = false
    }
    else {
        $('.add_Cable_Form').css('display', 'none')
        addCableVw = false
        addCableLine.remove(map)
        addLineMarkers = []
    }
}

function updatePlotLine(latlng){
    addLineMarker.push(latlng)
    addCableLine.addLatLng(latlng)
}

function addCableDB(){
    $.ajax({
        type: 'POST',
        url: './inc/func/func_updateCableTbl.php',
        data: { 
            addCable: true, 
            desc: $('#cable-desc').val(),
            core: $('#cable-core').val(),
            type: $('#cable-type').val(),
            latlngs: JSON.stringify(addLineMarker)
        },
        cache: false,
        success: function(data){
            console.log(data)
            window.location.href = './cmsofc.php'
        },
        error: (error, status, xhr)=>{console.log(xhr)}
    })
}

function getDBCables(){
    return JSON.parse($('#cablesData').attr('data-cables'))
}

function plotCables(dbCables){
    dbCables.forEach(cable => {
        lineMarkers[cable[0]] = new L.polyline(JSON.parse(cable[4]), {color: 'green'}).addTo(map)
        .on('mouseover', event => {
            event.target.bindPopup(`
                <div id="polePopup">
                    <p><b>Cable Information</b></p>
                    <p>Desc: ${cable[1]}</p>
                    <p>Core: ${cable[2]}</p>
                </div>`, {'closeButton': false})
            .openPopup()
        })
    });
}

function cleanMapLineMarker(){
    lineMarkers.forEach(i=>{
        i.remove(map)
    })
    lineMarkers = [];
}