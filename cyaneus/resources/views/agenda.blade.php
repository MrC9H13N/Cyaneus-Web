@include('master')
    <link rel="stylesheet" href="{{ asset('css/agenda.css') }}">
    <script src="{{ asset('js/events.js') }}"></script>
    <script src="{{ asset('js/agenda.js') }}"></script>
    <link href="{{ asset('js/fullcalendar/main.css') }}" rel='stylesheet' />
    <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment-with-locales.min.js'></script>
    <script src="{{ asset('js/fullcalendar/main.js') }}"></script>
    <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/moment@5.5.0/main.global.min.js'></script>
    <script src="{{ asset('js/fullcalendar/locales/fr.js') }}"></script>

    <title>Agenda</title>
</head>
<body>
@include('navbar')
<div id='calendar'></div>
</body>
</html>
