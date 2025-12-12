//* Map View Center Coordinates & Zoom
let mapOptions = {
    // center: [-9.45142, 147.19585], //?POM Center
    center: [-9.46852, 147.20168],
    zoom: 20
}

//* Initialize Map Element
let map = new L.map('mapCont', mapOptions)
let layer = new L.TileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png')
map.addLayer(layer)

//* Single Pole Icon
let customIcon1 = {
    iconUrl: "./inc/img/pole-tag.png",
    iconSize: [36, 50],
    iconAnchor: [18,50],
    popupAnchor: [0,-50]
}

//* Single Pole Icon With Splitter
let customIcon2 = {
    iconUrl: "./inc/img/polejbx-tag.png",
    iconSize: [36, 50],
    iconAnchor: [18,50],
    popupAnchor: [0,-50]
}

//* OLT Icon
let custOltIcon = {
    iconUrl: "./inc/img/olt-tag.png",
    iconSize: [36, 50],
    iconAnchor: [18,50],
    popupAnchor: [0,-50]
}

let myIcon1 = L.icon(customIcon1)
let myIcon2 = L.icon(customIcon2)
let oltIcon = L.icon(custOltIcon)

let iconOptions = { icon: '' }

//* Marker Collection Variable
markers = {}

//? Event to trigger when a location on map is clicked
map.on('click', (event)=>{
    $('#olt-coords').val(`${event.latlng.lat.toFixed(5)},${event.latlng.lng.toFixed(5)}`)
    $('#pole-lat').val(event.latlng.lat.toFixed(5))
    $('#pole-lng').val(event.latlng.lng.toFixed(5))
    closeTempVwOnMapClick()
})

function closeTempVwOnMapClick(){
    if(poleVw){
        $('.poleView').css('transform', 'translateX(400px)')
        poleVw = false
        closeJBVw()
    }
}

function plotPoles(pole_Data){
    pole_Data.forEach((i, idx)=>{
        //? Add Marker to Map
        if(i[4]==1)
            iconOptions.icon = myIcon2
        else
            iconOptions.icon = myIcon1

        markers[i[0]] = new L.Marker([parseFloat(i[1]), parseFloat(i[2])], iconOptions).addTo(map)
        
        //? Add PopUp Content
        .on("mouseover", event => {
            event.target.bindPopup(`
                <div id="polePopup">
                    <p>ID: ${i[0]}</p>
                    <p>Lat: ${parseFloat(i[1])}</p>
                    <p>Lng: ${parseFloat(i[2])}</p>
                    <p>Zone: ${i[3]}</p>
                </div>`, {'closeButton': false})
            .openPopup()
        })

        .on("mouseout", event => {
            event.target.closePopup()
        })
        
        .on("click", event => {
            $('#poleID').val(`${i[0]}`)
            $('#poleZone').val(`${i[3]}`)
            $('#poleCoords').val(`${i[1]}, ${i[2]}`)
            $('#delPoleId').val(`${i[0]}`)
            $('#jbpole-id').val(`${i[0]}`)
            $('#jbpole-id').text(`${i[3]}-${i[0]}`)
            poleVw = true
            $('.poleView').css('transform', 'translateX(-200px)')
            closeJBVw()
            $('.nodeHead').text('Pole Info')
            $('.jbCont').empty()
            i[4]==1 && poleVwJBs(i[0])
        })
    })
}

function plotPole(id, lat, lng, zon){
    if(id==1)
        iconOptions.icon = myIcon2
    else
        iconOptions.icon = myIcon1

    markers[id] = new L.Marker([parseFloat(lat), parseFloat(lng)], iconOptions).addTo(map)
    
    //? Add PopUp Content
    .on("mouseover", event => {
        event.target.bindPopup(`
            <div id="polePopup">
                <p>ID: ${id}</p>
                <p>Lat: ${parseFloat(lat)}</p>
                <p>Lng: ${parseFloat(lng)}</p>
                <p>Zone: ${zon}</p>
            </div>`, {'closeButton': false})
        .openPopup()
    })
        .on("mouseout", event => {
        event.target.closePopup()
    })
    
    .on("click", event => {
        poleVw = true
        $('.poleView').css('transform', 'translateX(-200px)')
        $('#poleID').val(`${id}`)
        $('#poleZone').val(`${zon}`)
        $('#poleCoords').val(`${lat}, ${lng}`)
        $('#delPoleId').val(`${id}`)
    })
}

function plotOlts(olt_Data){
    olt_Data.forEach((i, idx)=>{
        let coordArr = i[3].split(',')
        new L.Marker([coordArr[0],coordArr[1]], iconOptions).addTo(map)

        .on("mouseover", event => {
            event.target.bindPopup(`
                <div id="polePopup">
                    <p>ID: ${i[0]}</p>
                    <p>Lat: ${coordArr[0]}</p>
                    <p>Lng: ${coordArr[1]}</p>
                    <p>Zone: ${i[1]}</p>
                </div>`, {'closeButton': false})
            .openPopup()
        })

        .on('click', event =>{
            $('.poleView').css('transform', 'translateX(-200px)')
            poleVw=true
            closeJBVw()
            $('#poleID').val(`${i[0]}`)
            $('#poleZone').val(`${i[1]}`)
            $('#poleCoords').val(`${coordArr[0]}, ${coordArr[1]}`)
            $('.jbCont').empty()
            $('.nodeHead').text('OLT Info')
        })
    })
}

function plotLine(){
    //* Create A Line
    new L.polyline([[-9.46925,147.20078],[-9.46901,147.20109]], {color: 'red'}).addTo(map)
}

function mdgVw(){
    map.setView([-5.21874, 145.80520])
}

function pomVw(){
    map.setView([-9.45142, 147.19585])
}