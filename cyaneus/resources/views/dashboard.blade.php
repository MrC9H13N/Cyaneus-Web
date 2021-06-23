@include('master')
    <script>
        //Valeurs à modifier en fonction de la BDD
        let home = "@php echo DB::table('users')->where('uuid', session('userID'))->value('adresse'); @endphp";
        let school = [50.63415509710043, 3.0487966239874265];
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
        @php
            $data_endpoint = json_decode(DB::table('users')->where('uuid', session('userID'))->value('notes'), true);

            $oldest_timestamp = 0;
            $oldest_name = '';
            $oldest_note = '';

            foreach($data_endpoint as $a){
               if($oldest_timestamp < strtotime(substr($a['Date'],6,4)."-".substr($a['Date'],3,2)."-".substr($a['Date'],0,2))){
                    $oldest_timestamp = strtotime(substr($a['Date'],6,4)."-".substr($a['Date'],3,2)."-".substr($a['Date'],0,2));
                    $oldest_name = $a['Nom'];
                    $oldest_note = $a['Note'];
               }
            }
        @endphp
        <div class="col">
            <div class="card">
                <div class="card-header">Dernière note</div>
                <div class="card-body">
                    <h1 id="note" class="center"> {{ $oldest_note }}</h1>
                    <h5 id="matiere" class="center">{{ $oldest_name }}</h5>
                    <h5 id="date" class="center">{{ date('d/m/Y', $oldest_timestamp) }}</h5>
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
        message: '<b>Bievenue @php echo session('userName'); @endphp !</b> Voici la version 0.1 de Cyaneus.'
    });
</script>
</body>
</html>
