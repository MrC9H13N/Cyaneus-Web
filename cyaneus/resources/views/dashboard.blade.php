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
        </div>
        <div class="col">
            <div class="card">
                <div class="card-header">Prochain cours</div>
                <div class="card-body">
                    </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
