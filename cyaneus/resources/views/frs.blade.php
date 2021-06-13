@include('master')
    <link rel="stylesheet" href="{{ asset('css/frs.css') }}">
    <script type="text/javascript" src="https://unpkg.com/webcam-easy/dist/webcam-easy.min.js"></script>
    <script src="{{ asset('js/frs.js') }}"></script>
    <title>Facial Recognition Setup</title>
</head>
<body>
@include('navbar')
    <div class="card mx-auto videocard text-center">
        <div class="card-header">
            Paramétrage de la reconaissance faciale
        </div>
        <div class="card-body">
            <video id="webcam" autoplay playsinline width="640" height="480"></video>
            <canvas id="canvas" class="d-none"></canvas>
            <br>
            <button type="submit" class="btn btn-primary" id="save"><i class="bi bi-save"></i> <strong>Enregistrer</strong></button>
        </div>
        <div class="card-footer text-muted">
            Votre visage doit être visible de face et dans son intégralité. Il ne doit y avoir qu'un seul visage.
        </div>
    </div>

</body>
</html>
