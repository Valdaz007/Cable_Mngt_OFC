let mapOptions = {
    center: [-9.45142, 147.19585],
    zoom: 14
}

let map = new L.map('mapCont', mapOptions)
let layer = new L.TileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png')
map.addLayer(layer)

let customIcon1 = {
    iconUrl: "./inc/img/ofc-pole3.png",
    iconSize: [40, 40],
    iconAnchor: [20,40],
    popupAnchor: [0,-40]
}

let customIcon2 = {
    iconUrl: "./inc/img/ofc-pole5.png",
    iconSize: [40, 40],
    iconAnchor: [20,40],
    popupAnchor: [0,-40]
}

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
    icon: myIcon1
}

//? Pull In Pole Coordinates & Add Marker to Map
let poles = $('#polesData').attr('data-poles')
poles = JSON.parse(poles)

poles.forEach((i, idx)=>{
    //? Add Marker to Map
    if(i[4]==1)
        iconOptions.icon = myIcon2
    else
        iconOptions.icon = myIcon1

    new L.Marker([parseFloat(i[1]), parseFloat(i[2])], iconOptions).addTo(map)
    
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
        $('#mapCont').load('./inc/temp/temp_poleView.php', {'pole':[`${i[0]}`, `${i[1]}`, `${i[2]}`, `${i[3]}`]})
    })
})

//? Pull OLTs Coords & Add Marker
iconOptions.icon = oltIcon

let olts = $('#oltsData').attr('data-olts')
olts = JSON.parse(olts)

olts.forEach((i, idx)=>{
    let coordArr = i[3].split(',')
    new L.Marker([coordArr[0],coordArr[1]], iconOptions).addTo(map)
})

//? Event to trigger when a location on map is clicked
map.on('click', (event)=>{
    $('#olt-coords').val(`${event.latlng.lat.toFixed(5)},${event.latlng.lng.toFixed(5)}`)
    $('#pole-lat').val(event.latlng.lat.toFixed(5))
    $('#pole-lng').val(event.latlng.lng.toFixed(5))
})

function mdgVw(){
    map.setView([-5.21874, 145.80520])
}

function pomVw(){
    map.setView([-9.45142, 147.19585])
}