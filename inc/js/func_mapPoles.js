//* Map View Center Coordinates & Zoom
let mapOptions = {
    center: [-9.45142, 147.19585],
    zoom: 14
}

//* Custom Map Icons
let map = new L.map('mapCont', mapOptions)
let layer = new L.TileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png')
map.addLayer(layer)

//* Single Pole Icon
let customIcon1 = {
    iconUrl: "./inc/img/ofc-pole3.png",
    iconSize: [40, 40],
    iconAnchor: [20,40],
    popupAnchor: [0,-40]
}

//* Single Pole Icon With Splitter
let customIcon2 = {
    iconUrl: "./inc/img/ofc-pole5.png",
    iconSize: [40, 40],
    iconAnchor: [20,40],
    popupAnchor: [0,-40]
}

//* OLT Icon
let custOltIcon = {
    iconUrl: "./inc/img/olt.png",
    iconSize: [40, 15],
    iconAnchor: [20,15],
    popupAnchor: [0,-20]
}

let myIcon1 = L.icon(customIcon1)
let myIcon2 = L.icon(customIcon2)
let oltIcon = L.icon(custOltIcon)

let iconOptions = {
    icon: ''
}

//* Marker Collection Variable
markers = {}

//? Event to trigger when a location on map is clicked

map.on('click', (event)=>{
    $('#olt-coords').val(`${event.latlng.lat.toFixed(5)},${event.latlng.lng.toFixed(5)}`)
    $('#pole-lat').val(event.latlng.lat.toFixed(5))
    $('#pole-lng').val(event.latlng.lng.toFixed(5))
})

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
            $('.poleView').css('transform', 'translateX(-200px)')
            $('#poleID').val(`${i[0]}`)
            $('#poleZone').val(`${i[3]}`)
            $('#poleLat').val(`${i[1]}`)
            $('#poleLng').val(`${i[2]}`)
            $('#delPoleId').val(`${i[0]}`)
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
        $('.poleView').css('transform', 'translateX(-200px)')
        $('#poleID').val(`${id}`)
        $('#poleZone').val(`${zon}`)
        $('#poleLat').val(`${lat}`)
        $('#poleLng').val(`${lng}`)
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
            $('#poleID').val(`${i[0]}`)
            $('#poleZone').val(`${i[1]}`)
            $('#poleLat').val(`${coordArr[0]}`)
            $('#poleLng').val(`${coordArr[1]}`)
        })
    })
}

function mdgVw(){
    map.setView([-5.21874, 145.80520])
}

function pomVw(){
    map.setView([-9.45142, 147.19585])
}