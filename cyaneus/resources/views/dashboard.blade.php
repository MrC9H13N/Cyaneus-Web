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
    <h1>Dashboard</h1>
    <div id='printoutPanel'></div>
    <div id="myMap" style="position:relative;width:600px;height:400px;"></div>
</body>
</html>
