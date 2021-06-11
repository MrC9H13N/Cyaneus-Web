@include('master')
<link rel="stylesheet" href="{{ asset('css/contact.css') }}">
<script src="{{ asset('js/contact.js') }}"></script>

<title>Contact</title>
</head>
<body>
@include('navbar')

<div class="button_cont" id="mail" align="center">
    <a class="example_d" href="mailto:app@cyaneus.chronos.red" rel="nofollow noopener noreferrer" draggable="false">
        <i class="bi bi-envelope-open"></i> Envoyez nous un mail : <strong>app@cyaneus.chronos.red</strong>
    </a>
</div>
<div class="button_cont" id="appli" align="center">
    <a class="example_d" href="https://play.google.com/store/apps/details?id=red.chronos.cyaneus" rel="nofollow noopener noreferrer" draggable="false">
        <i class="bi bi-app-indicator"></i> Laisser un avis sur notre application
    </a>
</div>
</body>
</html>
