@include('master')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <title>Accueil</title>
</head>
<body>
    <div class="center my-5">
        <img id="bird" src="{{ asset('assets/images/bird.png') }}">
        <h1>Cyaneus</h1>
    </div>
    <br><br><br>
    <div class="d-grid gap-3 col-4 mx-auto">
        <button class="btn btn-outline-primary" type="button">Se connecter</button>
        <button class="btn btn-primary" type="button">Créer un compte</button>
    </div>

</body>
</html>
