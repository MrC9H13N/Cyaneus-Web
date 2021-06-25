let webcam;

//Initialisation de la webcam
document.addEventListener("DOMContentLoaded", function(){
    const webcamElement = document.getElementById('webcam');
    const canvasElement = document.getElementById('canvas');
    webcam = new Webcam(webcamElement, 'user', canvasElement);

    webcam.start()
        .then(result =>{
        })
        .catch(err => {
            console.log(err);
        });
    webcamElement.style.transform = "scale(-1,1)";
    document.getElementById("save").addEventListener("click", function(){
        document.getElementById("buttonDiv").innerHTML = '<button class="btn btn-primary" type="button" disabled>\n' +
            '                                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>\n' +
            '                                    Chargement ...\n' +
            '                                </button>';
        //On envoie la requête de d'enregistrement
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "/addUserPicture", true);
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.setRequestHeader('X-CSRF-TOKEN', document.getElementsByName('_token')[0].getAttribute('content'));
        xhr.onreadystatechange = function () {
            if (this.readyState != 4) return;
            if (this.status == 200) {
                window.location.href = '/settings';
            }
        };

        xhr.send(JSON.stringify({
            picture: webcam.snap(),
        }));
    });
});