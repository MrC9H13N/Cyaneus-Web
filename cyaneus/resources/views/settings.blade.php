@include('master')
    <link rel="stylesheet" href="{{ asset('css/settings.css') }}">
    <script src="{{ asset('js/settings.js') }}"></script>

    <title>Paramètres</title>
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
                <div class="card-header">Header</div>
                <div class="card-body text-dark">
                    <h5 class="card-title">Dark card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card border-dark">
                <div class="card-header">Header</div>
                <div class="card-body text-dark">
                    <h5 class="card-title">Dark card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card border-dark">
                <div class="card-header">Header</div>
                <div class="card-body text-dark">
                    <h5 class="card-title">Dark card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
