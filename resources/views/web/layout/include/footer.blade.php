<footer class="page-width">
    <div class="wrapper-container">
        <div class="top-content">
            <div class="left">
                <div class="logo">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('assets/web/images/White Logo - Copy.png') }}" alt="">
                    </a>
                </div>
                <div class="footer-menu">
                    <a href="{{ route('home') }}#about">About</a>
                    <a href="{{ route('home') }}#price">Price</a>
                    <a href="{{ route('home') }}#how-it-works">How it works</a>
                    <a href="{{ route('home') }}#blog">Blog</a>
                    <a href="{{ route('home') }}#contact">Contact</a>
                </div>
            </div>
            <div class="right">
                <p>Subscribtion for more information</p>
                <form action="{{ route('web.news-letter.store') }}" method="post">
                    @csrf
                    <input type="email" name="email" placeholder="Your email address…" required>
                    <button type="submit">Subscribe</button>
                </form>
            </div>
        </div>
        <div class="bottom-content">
            <div class="left">
                <a href="{{ route('privacy-policy') }}">Privacy Policy</a>
                <a href="{{ route('terms-of-service') }}">Terms of Service</a>
                <a href="{{ route('agreement') }}">Agreement</a>
            </div>
            <div class="right">
                <a href="http://">
                    <i class="fa fa-facebook-f"></i>
                </a>
                <a href="http://">
                    <i class="fa fa-twitter"></i>
                </a>
                <a href="http://">
                    <i class="fa fa-instagram"></i>
                </a>
                <a href="http://">
                    <i class="fa fa-youtube"></i>
                </a>
                <a href="http://">
                    <i class="fa fa-linkedin"></i>
                </a>
            </div>
        </div>
        <p class="copy-right text-center">
            Copyright Design © {{ date('Y') }}. All right reserved
        </p>
    </div>
</footer>
