@extends('web.layout.app')

@section('title')
    ChillerWise
@endsection

@section('head')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/index.css') }}">
@endsection

@section('content')
<section id="section-template--1">
    <div class="wrapper-text">
        <h1 class="mb-3">UNLEASH THE POTENTIAL OF INTELLIGENT CHILLER STAGING</h1>
        <a href="http://" class="button button--primary">CALCULATE NOW</a>
    </div>
    <div class="wrapper-img">
        <img src="{{ asset('assets/web/images/banner.png') }}" alt="" width="100%" height="100%">
    </div>
</section>

<section id="section-template--2"></section>
<section id="section-template--3" class="page-width">
    <div class="wrapper">
        <div class="left">
            <div class="img-block">
                <img src="{{ asset('assets/web/images/welcome.png') }}" alt="" height="auto" width="100%">
            </div>
        </div>
        <div class="right">
            <div class="wrapper-content-block">
                <span>WELCOME TO</span>
                <img src="{{ asset('assets/web/images/Blue_Logo - Copy.png') }}" alt="" height="auto" width="100%">
                <h3>YOUR GATEWAY TO OPTIMAL CHILLER OPERATIONS!</h3>
                <p>
                    At ChillerWise, we specialize in innovative solutions for optimizing chiller operations in
                    commercial environments. Our web-based software empowers engineers and facility managers to
                    enhance
                    energy efficiency, improve performance, and reduce costs. With our comprehensive suite of tools,
                    you
                    can easily streamline the chiller optimization process. Our advanced algorithms calculate the
                    optimal combination of chillers for maximum efficiency and savings. Join our community of
                    professionals and experience the benefits of ChillerWise today. Start your journey toward
                    intelligent chiller optimization now.
                </p>
            </div>
        </div>

    </div>
</section>
<section id="section-template--4" class="page-width">
    <div class="wrapper">
        <div class="left">
            <h2>HOW IT WORKS</h2>
        </div>
        <div class="right">
            <div class="wrapper-content">
                <p><span>PAY PER PROJECT:</span>
                    Enjoy the freedom of paying for each project individually. This allows you to manage your budget
                    effectively and ensures that you are charged only for the services you require.
                </p>
                <p><span>ACCESS PAST PROJECTS:</span>
                    Your journey with ChillerWise is not just limited to the present. Gain access to all your
                    previous
                    projects, keeping a record of your chiller optimization efforts and allowing you to track your
                    progress over time.
                </p>
                <p><span>MANAGE YOUR PROFILE:</span>
                    Your ChillerWise profile serves as a central hub for all your project-related activities. Update
                    your information, track invoices, and have full control over your account settings.
                </p>
                <p><span>DISCOVER THE POWER OF CHILLERWISE'S PRICING:</span>
                    Your ChillerWise profile serves as a central hub for all your project-related activities. Update
                    your information, track invoices, and have full control over your account settings.
                </p>
                <p>
                    Get started with ChillerWise today and unlock the full potential of your chiller systems.
                </p>
            </div>
        </div>
    </div>
</section>

<section id="section-template--5" class="page-width">
    <div class="wrapper">
        <h2 class="pricing">PRICING</h2>
        <h4>UNLOCK THE POWER OF CHILLERWISE:</h4>
        <h6 class="mt-1">AFFORDABLE PRICING, PROJECT BY PROJECT</h6>
        <p class="my-4">
            At ChillerWise, we believe in providing flexibility and value to our users. Our pricing structure is
            designed to offer cost-effective solutions for each project you undertake. With ChillerWise, you only
            pay for the specific projects you work on, ensuring that you have control over your expenses.
        </p>
        <h2 class="per-project">
            $2000<br>
            <span>PER PROJECT</span>
        </h2>
        <a href="http://" class="button button--primary mt-4">
            START YOUR FIRST CALCULATION
        </a>
    </div>
</section>
<section id="section-template--6" class="page-width">
    <h3>LATES NEWS</h3>
    <div class="wrapper-container">
        <div class="wrapper-item">
            <a href="http://" class="img-box">
                <img class="card-img rounded-0" src="{{ asset('assets/web/images/banner.png') }}" alt="Suresh Dasari Card"
                    width="100%" height="100%">
            </a>
            <div class="wrapper-content">
                <div class="wrapper-content-text">
                    <a href="http://">
                        <h4 class="card-title">
                            Unlocking Efficiency: The Importance of Chiller Optimization with
                            ChillerWise
                        </h4>
                    </a>
                    <p class="card-text">
                        In today’s energy-conscious world,
                    </p>
                </div>
                <div>
                    <a href="#" class="read-more">
                        Read more <i class="fa fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="wrapper-item">
            <a href="http://" class="img-box">
                <img class="card-img rounded-0" src="{{ asset('assets/web/images/banner.png') }}" alt="Suresh Dasari Card"
                    width="100%" height="100%">
            </a>
            <div class="wrapper-content">
                <div class="wrapper-content-text">
                    <a href="http://">
                        <h4 class="card-title">
                            The quick, brown fox jumps over a lazy dog.
                        </h4>
                    </a>
                    <p class="card-text">
                        The quick, brown fox jumps over a lazy dog. DJs flock by when MTV ax quiz prog. Junk MTV
                        quiz graced by fox whelps. Bawds jog, flick quartz, vex nymphs. Waltz, bad
                        nymph,
                    </p>
                </div>
                <div>
                    <a href="#" class="read-more">
                        Read more <i class="fa fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="text-center">
        <a href="http://" class="button button--primary">
            VIEW MORE NEWS
        </a>
    </div>
</section>
<section id="section-template--7" class="page-width">
    <div class="wrapper">
        <form action="#" method="post">
            <input type="text" id="fullName" name="fullName" placeholder="Full Name:" required>
            <input type="email" id="email" placeholder="Email Address:" name="email" required>
            <input type="tel" id="contactNumber" name="contactNumber" placeholder="Contact Number:" required>
            <textarea id="message" name="message" rows="4" placeholder="Message:" required></textarea>
            <div class="submit-button">
                <button type="submit" class="button button--primary">Send</button>
            </div>
        </form>
        <div class="form-detail">
            <ul>
                <li>
                    <i class="fa fa-location-dot"></i>
                    <div>
                        <h5>OFFICE ADDRESS</h6>
                            <span>2704 William Street Saratoga <br> Springs, NY 12866</span>
                    </div>
                </li>
                <li>
                    <i class="fa fa-message"></i>
                    <div>
                        <h5>OFFICE ADDRESS</h6>
                            <span>info@chaurus.com <br> support@chaurus.com</span>
                    </div>
                </li>
                <li>
                    <i class="fa fa-phone"></i>
                    <div>
                        <h5>OFFICE ADDRESS</h6>
                            <span>+1-202-555-0170 <br> +1-202-555-0121</span>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</section>
@endsection