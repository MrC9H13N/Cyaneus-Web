let webcam;

//Initialisation de la webcam
document.addEventListener("DOMContentLoaded", function(){
    const webcamElement = document.getElementById('webcam');
    const canvasElement = document.getElementById('canvas');
    webcam = new Webcam(webcamElement, 'user', canvasElement);

    webcam.start()
        .then(result =>{
            console.log("webcam started");
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
        //On envoie la requête de connexion
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "/connectUserWithPicture", true);
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.setRequestHeader('X-CSRF-TOKEN', document.getElementsByName('_token')[0].getAttribute('content'));
        xhr.onreadystatechange = function () {
            if (this.readyState != 4) return;
            if (this.status == 200) {
                console.log(this.responseText);
                if(this.responseText.includes("AuthenticationSuccessful")){
                    window.location.href = '/dashboard';
                } else {
                    window.location.href = '/logout';
                }

            }
        };

        xhr.send(JSON.stringify({
            picture: webcam.snap(),
            mail : document.getElementById('mail').value
        }));;
    });
});