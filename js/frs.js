let webcam;

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