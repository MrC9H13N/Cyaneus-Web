//S'éxécute après le chargement de la page
document.addEventListener("DOMContentLoaded", function(){
    document.getElementById("connect").onclick = function(){
        document.getElementById("boutons").setAttribute('style', 'display:none !important');
        document.getElementById("title").style.display = "none";
        document.getElementById("creation").style.display = "none";
        document.getElementById("connexion").style.display = "block";
    };
    document.getElementById("create").onclick = function(){
        document.getElementById("boutons").setAttribute('style', 'display:none !important');
        document.getElementById("title").style.display = "none";
        document.getElementById("connexion").style.display = "none";
        document.getElementById("creation").style.display = "block";
    };
});