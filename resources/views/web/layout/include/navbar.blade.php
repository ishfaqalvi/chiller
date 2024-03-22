<nav class="navbar navbar-expand-lg navbar-light sticky-top navbar-custom">
    <a class="navbar-brand" href="#">
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
                <a class="nav-link" href="#blog">Blog</a>
            </li>
        </ul>
        <div class="navbar-nav">
            <span class="btn btn-outline-primary button btn-custom">
                @auth('customers')
                <form method="POST" action="{{ route('customer.logout') }}">
                    @csrf
                    <a 
                        href="{{ route('customer.logout') }}"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        <i class="fas fa-sign-out me-2"></i>
                        LOGOUT
                    </a>
                </form>
                @else
                    <a href="{{ route('web.showLoginForm') }}"> LOGIN </a> 
                    / 
                    <a href="{{ route('web.showRegisterForm') }}"> SIGNUP </a>
                @endauth
            </span>
        </div>
    </div>
</nav>