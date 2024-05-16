@extends('web.layout.app')

@section('title')
    ChillerWise | Forgot Password
@endsection

@section('head')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/web/css/login.css') }}">
@endsection

@section('content')
<section id="login-section">
    <div class="row form-wrap">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="login-content">
                <h4>WELCOME BACK TO</h4>
                <img src="{{ asset('assets/web/images/logo-icon.png') }}" class="icon-img">
                <p>
                    We’re glad to have you back. Please enter your login credentials to access your account and continue optimizing your chiller operations with ease. If you have any questions or need assistance, our support team is here to help. Thank you for choosing ChillerWise!
                </p>
                <p> Login to your account and stay on top of your chiller optimization journey.</p>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 login-form-bg" style="background-image: url({{ asset('assets/web/images/form-bg.png') }});">
            <div class="login-form">
                <h4>Reset Password</h4>
                <form action="{{ route('web.password.update') }}" method="POST" id="validate">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="email-field">
                        <input type="email" placeholder="Enter Email" id="email" name="email" required>
                    </div>
                    <div class="email-field">
                        <input type="password" placeholder="Enter Password" id="email" name="password" required>
                    </div>
                    <div class="email-field">
                        <input type="password" placeholder="Confirm Password" id="email" name="password_confirmation" required>
                    </div>
                    <div class="form-btns">
                        <div class="forget-btn">
                            <a href="{{ route('web.showLoginForm') }}" class="btn">Back to login?</a>
                        </div>
                        <div class="sign-btn">
                            <button type="submit" class="btn" id="sign" value="Sign in">Submit</button>
                        </div>
                    </div>
                    <div class="divider"> <span> or </span> </div>
                    <div class="brand-btns">
                        <div class="google-btn">
                            <a href="{{ route('web.login.google') }}" class="btn" id="google">
                                <img src="{{ asset('assets/web/images/google.png') }}" width="18px" height="18px">
                                <span> Google </span>
                            </a>
                        </div>
                        <div class="fcbk-btn">
                            <a href="{{ route('web.login.facebook') }}" class="btn" id="facebook">
                                <img src="{{ asset('assets/web/images/facebook.svg') }}" width="25px" height="25px">
                                <span> Facebook </span>
                            </a>
                        </div>
                    </div>
                    <div class="copyright-txt">
                        <p>
                            Protected by reCAPTCHA and subject to the Name Privacy Policy and Terms of Service.
                        </p>
                    </div>
                    <div class="createuser-btn">
                        <a href="{{ route('web.showRegisterForm') }}" class="btn">New user? Create an account</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')
<script type="text/javascript">
$(document).ready(function() {
    $("#validate").validate({
        errorClass: 'invalid',
        successClass: 'success',
        validClass: 'success',
        errorElement: 'span',
        errorClass: 'error',
        highlight: function(element) {
            $(element).removeClass('success');
            $(element).addClass('invalid');
        },
        unhighlight: function(element) {
            $(element).removeClass('invalid');
            $(element).addClass('success');
        },
        errorPlacement: function(error, element) {
            error.insertAfter(element);
        }
    });
});
</script>
@endsection
