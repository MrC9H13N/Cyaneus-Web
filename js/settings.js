//Renvoie [latitude, longitude] d'une adresse précise
function getCoorFromAdress(adress){
    Microsoft.Maps.loadModule('Microsoft.Maps.Search', function () {
        var searchManager = new Microsoft.Maps.Search.SearchManager(map);
        var requestOptions = {
            bounds: map.getBounds(),
            where: adress,
            callback: function (answer, userData) {
                map.setView({ bounds: answer.results[0].bestView });
                return([answer.results[0].location.latitude,answer.results[0].location.longitude])
            }
        };
        searchManager.geocode(requestOptions);
    });
}