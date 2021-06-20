@if(!session()->has('userID'))
    <script>window.location = "/";</script>
@endif

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
                    <a class="nav-link" href="/notes"><i class="bi bi-book"></i> Notes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/settings"><i class="bi bi-gear"></i> Paramètres</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/contact"><i class="bi bi-envelope"></i> Contact</a>
                </li>
            </ul>

        </div>
        <form class="form-inline my-2 my-lg-0" name="logout" method="post" action="{{url('/logout')}}">
            @csrf
            <button class="btn btn-outline-danger my-2 my-sm-0" type="submit"><i class="bi bi-arrow-bar-left"></i> Déconnexion</button>
        </form>
    </div>
</nav>
