jbs = JSON.parse($('#jbsData').attr('data-jbs'))    //? Ref: func_map.js

//* Set Custom Marker Icon (Pole)
iconOptions.icon = myIcon1

//* Plot Pole Markers On Map
plotPoles(JSON.parse($('#polesData').attr('data-poles')))

//* Set Custom Marker Icon (OLT)
iconOptions.icon = oltIcon

//* Plot OLTs Markers On Map
plotOlts(JSON.parse($('#oltsData').attr('data-olts')))

//* Plot Cable Line Markers
plotCables(getDBCables())