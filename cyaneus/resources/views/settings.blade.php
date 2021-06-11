@include('master')
    <script>
        //Valeurs à afficher en fonction de la BDD
        let adresse = "@php echo DB::table('users')->where('uuid', session('userID'))->value('adresse'); @endphp";
    </script>
    <link rel="stylesheet" href="{{ asset('css/settings.css') }}">
    <script src="{{ asset('js/settings.js') }}"></script>

    <title>Paramètres</title>
    <script src="https://cdn.jsdelivr.net/gh/bigdatacloudapi/js-reverse-geocode-client@latest/bigdatacloud_reverse_geocode.min.js" type="text/javascript"></script>
    <script type='text/javascript'
        src='https://www.bing.com/api/maps/mapcontrol?callback=GetMap&key=Arj8WiNOGG2FaV4XLSxy7GHXhOTN8hXURwFNOdnXtwBhWmGu5xo_0ssZmWzZImHO'
        async defer></script>
    </head>
<body>
@include('navbar')
<!--<div id="settings"  class="col-md-4 col-md-offset-4">
    <form name="settings" method="post" action="{{url('/settings')}}">
        @csrf
        <legend>⚙️Paramètres</legend>
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
        <button type="submit" class="btn btn-success" id="saveSettings"><i class="bi bi-save"></i> <strong>Enregistrer mes données</strong></button>
    </form>
</div>-->
<div id="settingsContainer">
    <legend>⚙️Paramètres</legend>
    <hr/>
    <div class="row row-cols-1 row-cols-md-2 g-4">
        <div class="col">
            <div class="card border-dark">
                <div class="card-header">Mot de passe</div>
                <div class="card-body text-dark">
                    <p class="card-text">
                    <form name="changePassword whiteFormText" method="post" action="{{url('/changePassword')}}">
                        @csrf
                        <div class="mb-3">
                            <label for="newPassword" class="form-label">Nouveau mot de passe</label>
                            <input type="password" class="form-control" id="newPassword" name="newPassword">
                        </div>
                        <div class="mb-3">
                            <label for="newPasswordConfirm" class="form-label">Confirmation du nouveau mot de passe</label>
                            <input type="password" class="form-control" id="newPasswordConfirm" name="newPasswordConfirm">
                        </div><br>
                        <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> <strong>Enregistrer</strong></button>
                    </form>
                    </p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card border-dark">
                <div class="card-header">Localisation</div>
                <div class="card-body text-dark">
                    <p class="card-text">
                    <form name="changeAdress whiteFormText" method="post" action="{{url('/changeAdress')}}">
                        @csrf
                        <label for="coord" class="form-label">Coordonnées</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="coord" name="coord">
                            <div class="input-group-append" id="loadingButton">
                                <button class="btn btn-success" type="button" id="locate"><i class="bi bi-cursor"></i> Me localiser</button>
                            </div>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> <strong>Enregistrer</strong></button>
                    </form>
                    </p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card border-dark">
                <div class="card-header">Dashboard</div>
                <div class="card-body text-dark">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
                        <label class="form-check-label" for="flexSwitchCheckChecked">Affichage de la dernière note</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card border-dark">
                <div class="card-header">Reconaissance faciale</div>
                <div class="card-body text-dark" id="facialContainer">
                    <button type="submit" class="btn btn-success" id="facialParam"><i class="bi bi-camera"></i> <strong>Paramétrer la reconaissance faciale</strong></button>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
<script> //Affichage des erreurs de connexion et de création de compte
    document.addEventListener("DOMContentLoaded", function(){
        var notyf = new Notyf({
            duration:4000,
            ripple:true,
            dismissible:true,
            position:{x:'right',y:'top'}
        });
        let err = "{!! $code ?? '' !!}";
        if(err === "passOK") notyf.success('Changement de mot passe réussi');
        if(err === "adressOK") notyf.success('Changement d\'adresse réussi');
        if(err === "passDiff") notyf.error('Mauvaise confirmation du mot de passe');
    });
</script>
</body>
</html>
