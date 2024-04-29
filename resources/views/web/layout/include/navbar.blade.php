<nav class="navbar navbar-expand-lg navbar-light sticky-top navbar-custom">
    <a class="navbar-brand" href="{{ route('home') }}">
        <img src="{{ asset('assets/web/images/Group 77.svg') }}">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="#about">About</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#how-it-works">How it works</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#price">Price</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#contact">Contact</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('web.blogs.index') }}">Blog</a>
            </li>
        </ul>
        <div class="navbar-nav">
            @auth('customers')
                <a href="{{ route('customer.profile') }}" class="btn profile-btn">Profile</a>
                    <span class="btn-divider">| </span>
                <a href="{{ route('customer.logout') }}" class="btn signout-btn" onclick="event.preventDefault(); document.getElementById('logout').submit();">Sign Out</a>
                <form method="POST" action="{{ route('customer.logout') }}" id="logout">
                    @csrf
                </form>
            @else
                <span class="btn btn-outline-primary button btn-custom">
                    <a href="{{ route('web.showLoginForm') }}"> LOGIN </a>
                    /
                    <a href="{{ route('web.showRegisterForm') }}"> SIGNUP </a>
                </span>
            @endauth
        </div>
    </div>
</nav>
