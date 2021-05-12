function GetMap()
{
    var map = new Microsoft.Maps.Map('#myMap');
    Microsoft.Maps.loadModule('Microsoft.Maps.Traffic', function () {
        var manager = new Microsoft.Maps.Traffic.TrafficManager(map);
        manager.show();
    });
    map.setOptions({
        showCopyright:false,
        disableBirdseye : true,
        disableStreetside: true,
    });
    Microsoft.Maps.loadModule('Microsoft.Maps.Directions', function () {
        var directionsManager = new Microsoft.Maps.Directions.DirectionsManager(map);
        directionsManager.setRequestOptions({ routeMode: Microsoft.Maps.Directions.RouteMode.driving });
        var waypoint1 = new Microsoft.Maps.Directions.Waypoint({ address: 'Domicile', location: new Microsoft.Maps.Location(home[0], home[1]) });
        var waypoint2 = new Microsoft.Maps.Directions.Waypoint({ address: 'ISEN Lille', location: new Microsoft.Maps.Location(school[0], school[1]) });
        directionsManager.addWaypoint(waypoint1);
        directionsManager.addWaypoint(waypoint2);
        directionsManager.setRenderOptions({ itineraryContainer: document.getElementById('printoutPanel') });
        directionsManager.calculateDirections();
    });

    //Add your post map load code here.
}