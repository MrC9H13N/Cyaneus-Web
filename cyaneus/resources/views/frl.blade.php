@include('master')
<link rel="stylesheet" href="{{ asset('css/frl.css') }}">
<meta name="_token" content="{{ csrf_token() }}">
<script type="text/javascript" src="https://unpkg.com/webcam-easy/dist/webcam-easy.min.js"></script>
<script src="{{ asset('js/frl.js') }}"></script>
<title>Facial Recognition Login</title>
</head>
<body>
<div class="card mx-auto videocard text-center">
    <div class="card-header">
        Connexion par reconaissance faciale
    </div>
    <div class="card-body">
        <video id="webcam" autoplay playsinline width="640" height="480"></video>
        <canvas id="canvas" class="d-none"></canvas>
        <br>
        <label for="mailConnect"class="form-label">Adresse mail</label><br><br>
        <div id="divAddon" class="input-group mb-3">
            <input type="text" class="form-control" id="mail" name="mail" aria-describedby="addonConnect">
            <span class="input-group-text" id="addonConnect">@student.junia.com</span>
        </div>
        <div id="buttonDiv">
            <button type="submit" class="btn btn-primary" id="save"><i class="bi bi-camera"></i> <strong>Me connecter</strong></button>
        </div>
         </div>
    <div class="card-footer text-muted">
        Votre visage doit être visible de face et dans son intégralité. Il ne doit y avoir qu'un seul visage.
    </div>
</div>

<div id="postContainer"></div>

</body>
</html>
