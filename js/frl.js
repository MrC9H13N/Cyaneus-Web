let webcam;

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
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "/connectUserWithPicture", true);
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.setRequestHeader('X-CSRF-TOKEN', document.getElementsByName('_token')[0].getAttribute('content'));
        xhr.onreadystatechange = function () {
            if (this.readyState != 4) return;
            if (this.status == 200) {
                console.log(this.responseText);
                if(this.responseText.includes("AuthenticationSucceed")){
                    window.location.href = '/dashboard';
                } else {
                    window.location.href = '/logout';
                }

            }
        };

        xhr.send(JSON.stringify({
            picture: webcam.snap(),
            mail : document.getElementById('mail').value
        }));
        //console.log(webcam.snap());
    });
});