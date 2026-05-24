<nav class="navbar navbar-expand-lg" id="dwidth">
    <div class="container-fluid">

        <button class="navbar-toggler d-lg-none dashboard-sidebar-toggler" type="button" data-bs-toggle="offcanvas"
            data-bs-target="#sidebarOffcanvas" aria-controls="sidebarOffcanvas" style="margin-right: 10px;">
            <span class="navbar-toggler-icon"></span>
        </button>

        <a href="{{ route('home') }}"><img width="50px" src="{{ asset('img/logo.png') }}" alt="Logo"
            class="img-fluid rounded-circle shadow-sm mb-2 mt-2"></a>
        <a class="navbar-brand" href="{{ route('home') }}">CareerPath</a>

        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navMain">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navMain">
            <ul class="navbar-nav ms-auto">
                @auth
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}">@csrf
                        <button class="btn2 btn-link nav-link">ÇIKIŞ YAP</button>
                    </form>
                </li>
                @else
                <li class="nav-item"><a class="nav-link {{ request()->is('login') ? 'active' : '' }}"
                        href="{{ route('login') }}">GİRİŞ YAP</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->is('register') ? 'active' : '' }}"
                        href="{{ route('register') }}">KAYIT OL</a></li>
                @endauth
            </ul>
        </div>
    </div>
</nav>