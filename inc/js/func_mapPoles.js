let mapOptions = {
    center: [-9.45142, 147.19585],
    zoom: 14
}

let map = new L.map('mapCont', mapOptions)
let layer = new L.TileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png')
map.addLayer(layer)

let customIcon = {
    iconUrl: "./inc/img/ofc-pole3.png",
    iconSize: [40, 40],
    iconAnchor: [20,40],
    popupAnchor: [0,-40]
}

let myIcon = L.icon(customIcon)

let iconOptions = {
    icon: myIcon
}

//? Pull In Pole Coordinates & Add Marker to Map
let poles = $('#polesData').attr('data-poles')
poles = JSON.parse(poles)

poles.forEach((i, idx)=>{
    //? Add Marker to Map
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
        console.log("Hello")
    })
})

//? Event to trigger when a location on map is clicked
map.on('click', (event)=>{
    $('#pole-lat').val(event.latlng.lat.toFixed(5))
    $('#pole-lng').val(event.latlng.lng.toFixed(5))
})

function mdgVw(){
    map.setView([-5.21874, 145.80520])
}

function pomVw(){
    map.setView([-9.45142, 147.19585])
}