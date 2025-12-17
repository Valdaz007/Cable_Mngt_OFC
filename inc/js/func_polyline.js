let addCableVw = false
var addCableLine = new L.polyline([], {color:'orange'}).addTo(map)
var addLineMarker = []

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
            type: $('#cable-desc').val(),
            latlngs: JSON.stringify(addLineMarker)
        },
        cache: false,
        success: function(data){
            console.log(data)
        },
        error: (error, status, xhr)=>{console.log(xhr)}
    })
}