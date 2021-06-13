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
        console.log(webcam.snap());
    });
});