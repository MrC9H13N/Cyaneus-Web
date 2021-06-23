@include('master')
    <script src="{{ asset('js/events.js') }}"></script>
    <script>
        //Valeurs à modifier en fonction de la BDD
        let home = "@php echo DB::table('users')->where('uuid', session('userID'))->value('adresse'); @endphp";
        let blur = "@php echo DB::table('users')->where('uuid', session('userID'))->value('blur'); @endphp";
        let school = [50.63415509710043, 3.0487966239874265];
        var todayDate = new Date().toISOString().slice(0, 10);

        const now = new Date();
        let closest = Infinity;
        let closestTitle;
        events.forEach(function(d) {
            const date = new Date(d.start);
            if (date >= now && (date < new Date(closest) || date < closest)) {
                closest = d.start;
                closestTitle = d.title;
            }
        });

        console.log(closest);
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
            $oldest_name = '/';
            $oldest_note = '/';
            if(!empty($data_endpoint)){


            foreach($data_endpoint as $a){
               if($oldest_timestamp < strtotime(substr($a['Date'],6,4)."-".substr($a['Date'],3,2)."-".substr($a['Date'],0,2))){
                    $oldest_timestamp = strtotime(substr($a['Date'],6,4)."-".substr($a['Date'],3,2)."-".substr($a['Date'],0,2));
                    $oldest_name = $a['Nom'];
                    $oldest_note = $a['Note'];
               }
            }
            } else {
                $noNote = true;
            }
        @endphp
        <div class="col">
            <div class="card">
                <div class="card-header">Dernière note</div>
                <div class="card-body">
                    @if(isset($noNote))
                        <h1 id="note" class="center">Pas de notes</h1>
                        <h5 id="matiere" class="center">Pas de notes</h5>
                        <h5 id="date" class="center">Pas de notes</h5>
                    @else
                        <h1 id="note" class="center"> {{ $oldest_note }}</h1>
                        <h5 id="matiere" class="center">{{ $oldest_name }}</h5>
                        <h5 id="date" class="center">{{ date('d/m/Y', $oldest_timestamp) }}</h5>
                    @endif
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
                    <h1 id="cours" class="center"></h1>
                    <h5 id="prof" class="center"></h5>
                </div>
            </div>
            <div class="card">
                <div class="card-header">Blague du jour</div>
                <div class="card-body">
                    <h5 id="blague" class="center">Quelles sont les deux sœurs qui ont la meilleure vue ?</h5>
                    <h5 id="reponse" class="center">Les sœurs jumelles.</h5>
                </div>
            </div>
        </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
<script>
    if(blur == 1){
        document.getElementById("note").style.filter = "blur(1.5vw)";
    }
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
