@include('master')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <script src="{{ asset('js/home.js') }}"></script>
    <title>Accueil</title>
</head>
<body>

    <div id="title">
        <div  class="center my-5">
            <img id="bird" src="{{ asset('assets/images/bird.png') }}">
            <h1>Cyaneus</h1>
        </div>
        <br><br><br>
    </div>

    <div id="boutons" class="d-grid gap-3 col-4 mx-auto">
        <button class="btn btn-outline-primary" id="connect" type="button"> <i class="bi bi-person-circle"></i> Se connecter</button>
        <button class="btn btn-primary" id="create" type="button"><i class="bi bi-pencil"></i> Créer un compte</button>
    </div>

    <div id="connexion" class="bg-primary p-5 m-5">
        <form>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <div id="creation">
        <h1>Création</h1>
    </div>

</body>
</html>
