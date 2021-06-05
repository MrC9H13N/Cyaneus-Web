@include('master')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <script src="{{ asset('js/home.js') }}"></script>
    <title>Accueil</title>
</head>
<body>
    <div id="title">
        <div  class="center my-5">
            <img id="birdBig" src="{{ asset('assets/images/bird.png') }}">
            <h1>Cyaneus</h1>
        </div>
        <br><br><br>
    </div>

    <div id="boutons" class="d-grid gap-3 col-4 mx-auto">
        <button class="btn btn-outline-primary" id="connect" type="button"> <i class="bi bi-person-circle"></i> Se connecter</button>
        <button class="btn btn-primary" id="create" type="button"><i class="bi bi-pencil"></i> Créer un compte</button>
    </div>

    <div id="connexion"  class="col-md-4 col-md-offset-4">

        <form name="connexion" method="post" action="{{url('/login')}}">
            @csrf
            <legend><img id="birdSmall" class="mx-3" src="{{ asset('assets/images/bird.png') }}">Connexion</legend>
            <hr/>
            <label for="mailConnect"class="form-label">Adresse mail</label><br><br>
            <div id="divAddon" class="input-group mb-3">
                <input type="text" class="form-control" id="mailConnect" name="mailConnect" aria-describedby="addonConnect">
                <span class="input-group-text" id="addonConnect">@student.junia.com</span>
            </div>
            <div class="mb-3">
                <label for="passwordConnect" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" id="passwordConnect" name="passwordConnect">
            </div><br>
            <button type="submit" class="btn btn-primary"><i class="bi bi-person-circle"></i> <strong>Se connecter</strong></button>
        </form>
    </div>

    <div id="creation"  class="col-md-4 col-md-offset-4">
        <form name="creation" method="post" action="{{url('/create')}}>
            @csrf
            <legend><img id="birdSmall" class="mx-3" src="{{ asset('assets/images/bird.png') }}">Créer un compte</legend>
            <hr/>
            <div class="mb-3">
                <label for="mail" class="form-label">Adresse mail</label>
                <input type="email" class="form-control" id="mailCreation">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" id="passwordCreation">
            </div>
            <div class="mb-3">
                <label for="passwordConfirm" class="form-label">Confirmation du mot de passe</label>
                <input type="password" class="form-control" id="passwordConfirmCreation">
            </div><br>
            <button type="submit" class="btn btn-primary"><i class="bi bi-pencil"></i> <strong>Créer mon compte Cyaneus</strong></button>
        </form>
    </div>

</body>
</html>
