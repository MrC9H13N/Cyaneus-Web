//Renvoie [latitude, longitude] d'une adresse précise
function getCoorFromAdress(adress){
    Microsoft.Maps.loadModule('Microsoft.Maps.Search', function () {
        var searchManager = new Microsoft.Maps.Search.SearchManager(map);
        var requestOptions = {
            bounds: map.getBounds(),
            where: adress,
            callback: function (answer, userData) {
                map.setView({ bounds: answer.results[0].bestView });
                return([answer.results[0].location.latitude,answer.results[0].location.longitude]);
            }
        };
        searchManager.geocode(requestOptions);
    });
}

//Récupère l'adresse en fonction de la position GPS de l'utilisateur
function getGeoData (){
    document.getElementById("loadingButton").innerHTML = '<button class="btn btn-success" type="button" disabled>\n' +
        '                                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>\n' +
        '                                    Chargement ...\n' +
        '                                </button>';

    if ("geolocation" in navigator) {
        var options = {
            enableHighAccuracy: true,
            timeout: 15000,
            maximumAge: 0
        };
        async function success(pos){
            console.log(pos.coords.accuracy);
            console.log(pos.coords.latitude+"+"+pos.coords.longitude);

            var request = new XMLHttpRequest();
            request.open('GET', "https://api.opencagedata.com/geocode/v1/json?q="+pos.coords.latitude+"+"+pos.coords.longitude+"&key=086a43aba9c14210b56b9885e8063e3b", true);

            request.onload = function() {
                if (request.status >= 200 && request.status < 400) {
                    var data = JSON.parse(request.responseText);
                    console.log("https://api.opencagedata.com/geocode/v1/json?q="+pos.coords.latitude+"+"+pos.coords.longitude+"&key=086a43aba9c14210b56b9885e8063e3b");
                    displayResult(data.results[0].components, pos.coords.accuracy);
                    console.log(data.results[0].components);

                } else {
                    alert("Erreur");
                }
            };
            request.onerror = function() {
                alert("Erreur");
            };
            request.send();

        }

        function error(err){
            alert("Géolocalisation impossible")
        }
        navigator.geolocation.getCurrentPosition(success, error, options);

    } else {
        alert("Géolocalisation impossible")
    }
}

//Affiche le résultat de la géolocation si le résultat est assez précis
function displayResult(data, precision){
    var notyf = new Notyf({
        duration:4000,
        ripple:true,
        dismissible:true,
        position:{x:'right',y:'top'}
    });

    if(data.house_number == null || data.street == null || data.city == null || precision > 500){
        notyf.error('Localisation trop imprécise, veuillez la rentrer manuellement');
    } else {
        document.getElementById("coord").value = data.house_number + " " + data.street + ", " + data.city;
    }

    document.getElementById("loadingButton").innerHTML = '<button class="btn btn-success" type="button" id="locate"><i class="bi bi-cursor"></i> Me localiser</button>';
    document.getElementById("locate").addEventListener("click", getGeoData);
}

document.addEventListener("DOMContentLoaded", function(){
    document.getElementById("coord").value = adresse;
    document.getElementById("locate").addEventListener("click", getGeoData);
    document.getElementById("facialParam").addEventListener("click", function(){
        window.location.href = "/frs";
    });
});
window.history.replaceState("a", "Paramètres", "/settings");