//* Get Plot Data From DOM
let poles = $('#polesData').attr('data-poles')
poles = JSON.parse(poles)

let olts = $('#oltsData').attr('data-olts')
olts = JSON.parse(olts)

//* Set Custom Marker Icon (Pole)
iconOptions.icon = myIcon1

//* Plot Pole Markers On Map
plotPoles(poles)

//* Set Custom Marker Icon (OLT)
iconOptions.icon = oltIcon

//* Plot OLTs Markers On Map
plotOlts(olts)