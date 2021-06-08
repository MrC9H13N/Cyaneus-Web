@include('master')
    <script>
        //Valeurs à modifier en fonction de la BDD
        var home = [50.71253184448871, 2.7865271836187877];
        var school = [50.63415509710043, 3.0487966239874265];
    </script>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <script src="{{ asset('js/dashboard.js') }}"></script>
    <script type='text/javascript'
            src='https://www.bing.com/api/maps/mapcontrol?callback=GetMap&key=Arj8WiNOGG2FaV4XLSxy7GHXhOTN8hXURwFNOdnXtwBhWmGu5xo_0ssZmWzZImHO'
            async defer></script>
    <title>Dashboard</title>
</head>
<body>
@include('navbar')
    <div class="row row-cols-1 row-cols-xl-3 g-4 m-3">
        <div class="col">
            <div class="card border">
                <div class="card-header">Trajet Domicile-Ecole</div>
                <div class="card-body">
                    <div id="myMap"></div>
                    <center><div id='printoutPanel'></div></center>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-header">Dernière note</div>
                <div class="card-body">
                    <h1 id="note" class="center">17</h1>
                    <h5 id="matiere" class="center">Electronique numérique</h5>
                    <h5 id="date" class="center">02/05/2021</h5>
                </div>
            </div>
            <div class="card">
                <div class="card-header">Météo</div>
                <div class="card-body row">
                    <center><img id="iconMeteo" src=""></center>
                    <h1 id="temp" class="center"></h1>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-header">Prochain cours</div>
                <div class="card-body">
                    <h1 id="cours" class="center">Pentesting</h1>
                    <h5 id="prof" class="center">Gabriel Chênevert - B802</h5>
                </div>
            </div>
            <div class="card">
                <div class="card-header">Blague du jour</div>
                <div class="card-body">
                    <h5 id="blagueTEMP" class="center">Quelles sont les deux sœurs qui ont la meilleure vue ?</h5>
                    <h5 id="reponseTEMP" class="center">Les sœurs jumelles.</h5>
                </div>
            </div>
        </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
<script>
    var notyf = new Notyf({
        duration:10000,
        ripple:true,
        dismissible:true,
        position:{x:'center',y:'bottom'},
        types: [
            {
                type: 'info',
                background: '#6ca4bc',
                icon: false
            }
        ]
    });
    notyf.open({
        type: 'info',
        message: '<b>Bievenue @php echo session('user'); @endphp !</b> Voici la version 0.1 de Cyaneus.'
    });
</script>
</body>
</html>
