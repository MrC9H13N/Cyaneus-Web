//API Bings Map - https://www.bingmapsportal.com/
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
}

function getBgColor(note) {
    var n;
    n = Math.round(Math.ceil(note));
    var gradient;
    gradient = {
        0: "FF0000",
        1: "F70B00",
        2: "F01700",
        3: "E92200",
        4: "E22E00",
        5: "DB3A00",
        6: "CE4505",
        7: "C1500A",
        8: "B55C0F",
        9: "A86714",
        10: "9C731A",
        11: "957B18",
        12: "8E8316",
        13: "878B14",
        14: "809312",
        15: "799C11",
        16: "61930F",
        17: "4A8B0E",
        18: "33820C",
        19: "1C7A0B",
        20: "1C7A0B"
    };
    var r;
    r = gradient[n];
    if (r == "") {
        r = "108A00";
    }
    return "#" + r;
}

document.addEventListener('DOMContentLoaded', function() {
    document.getElementById("note").style.color = getBgColor(document.getElementById("note").innerHTML);
});

