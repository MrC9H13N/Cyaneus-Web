//S'éxécute après le chargement de la page eet permet l'affichage des div de connexion et de création de compte
document.addEventListener("DOMContentLoaded", function(){
    let main = true;

    window.onpopstate = function(event) {
        if(event && !main){
            document.getElementById("boutons").setAttribute('style', 'block !important');
            document.getElementById("title").style.display = "block";
            document.getElementById("creation").style.display = "none";
            document.getElementById("connexion").style.display = "none";
            main = true;
        }
    }
    document.getElementById("connect").onclick = function(){
        history.pushState({}, "Cyaneus", window.location.href);
        document.getElementById("boutons").setAttribute('style', 'display:none !important');
        document.getElementById("title").style.display = "none";
        document.getElementById("creation").style.display = "none";
        document.getElementById("connexion").style.display = "block";
        main = false;
    };
    document.getElementById("create").onclick = function(){
        history.pushState({}, "Cyaneus", window.location.href);
        document.getElementById("boutons").setAttribute('style', 'display:none !important');
        document.getElementById("title").style.display = "none";
        document.getElementById("connexion").style.display = "none";
        document.getElementById("creation").style.display = "block";
        main = false;
    };
    document.getElementById("facialConnect").onclick = function(){
        window.location.href = "/frl";
    };
});
window.history.replaceState("a", "Accueil", "/");