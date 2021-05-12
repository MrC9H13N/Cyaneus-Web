<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{Request::root()}}">
            <img src="{{ asset('assets/images/bird.png') }}" alt="" width="30" height="30">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="/dashboard"><i class="bi bi-pin"></i> Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/agenda"><i class="bi bi-calendar-event"></i> Agenda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="bi bi-book"></i> Notes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/settings"><i class="bi bi-gear"></i> Paramètres</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
