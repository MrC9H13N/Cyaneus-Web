//API Bings Map - https://www.bingmapsportal.com/
let jokesToken = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyX2lkIjoiMjE0Mzk2MDUyMDg0NzUyMzg1IiwibGltaXQiOjEwMCwia2V5IjoicnozWURBN2ZMSEdYVFBrSVpGbHY2Y1YyMUlSdGFFeFJ6VUlaeTM0SUVXdjdMcTdVZWYiLCJjcmVhdGVkX2F0IjoiMjAyMS0wNS0yM1QwODoyMTozOSswMDowMCIsImlhdCI6MTYyMTc1ODA5OX0.IyBA-DfzaX3gLkqEmn7IfTZhG_5XJliNDFAU0Wr0RNQ";

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
    //On envoie la requête pour la météo
    let date = new Date();
    date = date.toISOString().slice(0, 10)+("0" + date.getHours()).slice(-2);
    date = date.replaceAll("-", "");
    let link = 'https://api.meteo-npdc.fr/prville/getGlobal.php?ville=Lille&time='+date
    console.log(link);
    fetch(link)
        .then(res => res.json())
        .then((out) => {
            document.getElementById("temp").innerHTML = Math.round(out.TMP)+"°C";
            document.getElementById("iconMeteo").src="https://meteo-npdc.fr/previ-ville/picto/"+out.test+".png";
            console.log(out);
        }).catch(err => console.error(err));

    //On change la couleur de la note
    document.getElementById("note").style.color = getBgColor(document.getElementById("note").innerHTML);

    //API Blague
    fetch('https://www.blagues-api.fr/api/type/global/random', {
        headers: {
            'Authorization': 'Bearer '+ jokesToken
        }
    })
        .then(response => response.json())
        .then(data => {
            console.log(data.joke);
            document.getElementById("blague").innerHTML = data.joke;
            document.getElementById("reponse").innerHTML = data.answer;
            /* Expected output:
            {
                "id": 1,
                "type": "dev",
                "joke": "Un développeur ne descend pas du métro.",
                "answer": "Il libère la RAM..."
            }
            */
        })
});

