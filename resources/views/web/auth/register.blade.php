@extends('web.layout.app')

@section('title')
    ChillerWise | Register
@endsection

@section('head')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/web/css/signup.css') }}">
@endsection

@section('content')
<section id="login-section">
    <div class="row form-wrap">
        <div class="col-lg-6 col-md-12 col-sm-12">
            <div class="login-content">
                <h4>SIGN UP NOW AND UNLOCK THE POWER OF</h4>
                <img src="{{ asset('assets/web/images/logo-icon.png') }}" class="icon-img">
                <p>
                    Ready to revolutionize your chiller operations? Join CHILLERWISE today and gain access to our powerful web-based software. Sign up now to streamline your chiller management, optimize energy efficiency, and maximize cost savings. 
                </p>
                <p>
                    With CHILLERWISE, you can register, enter your chiller data, and discover the optimal combination of chillers to run at each load step. Our intuitive interface and advanced algorithms make it easy for you to take control of your chiller system and achieve peak performance.
                </p>
                <p>
                    Don’t miss out on the opportunity to enhance your commercial environment’s efficiency. Sign up now and experience the benefits of CHILLERWISE.
                </p>
                <h5>
                    START YOUR JOURNEY TOWARDS SMARTER CHILLER OPERATIONS TODAY!
                </h5>
            </div>
        </div>
        <div class="col-lg-6 col-md-12 col-sm-12 login-form-bg" style="background-image: url({{ asset('assets/web/images/signup.png') }}">
            <div class="login-form signup-form">
                <h4>Sign up now to start your free trial.</h4>
                <span>Sign up now to start your free trial.</span> <a href="#">Sign in</a>
                <form action="{{ route('web.registger')}}" method="POST" id="validate">
                    @csrf
                    <div class="form-field-wrap">
                        <div class="fname-field">
                            <input type="text" placeholder="Eureka" id="fname" name="first_name" required>
                        </div>
                        <div class="lname-field">
                            <input type="text" placeholder="Seken" id="lname" name="last_name" required>
                        </div>
                    </div>
                    <div class="form-field-wrap">
                        <div class="email-field">
                            <input type="email" placeholder="Email" id="email" name="email" required>
                        </div>
                        <div class="job-field">
                            <select class="job-select" id="job" name="job_title" required>
                                <option value="">--Select--</option>
                                <option value="Job Title 1">Job Title 1</option>
                                <option value="Job Title 2">Job Title 2</option>
                                <option value="Job Title 3">Job Title 3</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-field-wrap">
                        <div class="email-field">
                            <input type="password" placeholder="Password" id="password" name="password" required>
                        </div>
                        <div class="email-field">
                            <input type="password" placeholder="Confirm Password" id="confirm_password" name="confirm_password" required>
                        </div>
                    </div>
                    <div class="form-field-wrap">
                        <div class="comapny-field">
                            <input type="text" placeholder="Company" id="company" name="company" required>
                        </div>
                        <div class="mobile-field">
                            <input type="text" placeholder="Mobile" id="mobile" name="mobile_number" required>
                        </div>
                    </div>
                    <div class="form-field-wrap">
                        <div class="employe-field">
                            <select class="employe-select" id="employees" name="employees" required>
                                <option value="">--Select Employees--</option>
                                <option value="Employees 1">Employees 1</option>
                                <option value="Employees 2">Employees 2</option>
                                <option value="Employees 3">Employees 3</option>
                            </select>
                        </div>
                        <div class="country-field">
                            <select class="country-select" id="country" name="country" required>
                                <option value="">--Select Country--</option>
                                <option value="Country 1">Country 1</option>
                                <option value="Country 2">Country 2</option>
                                <option value="Country 3">Country 3</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-check agree-input">
                        <input class="form-check-input" type="checkbox" value="" name="agree" id="agree" required>
                        <label class="form-check-label" for="flexCheckDefault">
                            <span>I agree to the</span> <a href="#">Master Subscription Agreement</a>
                        </label>
                    </div>
                    <div class="sign-btn mt-4">
                        <button type="submit" class="btn" id="sign" value="Sign in">Start</button>
                    </div>
                    <div class="divider"> <span> or </span> </div>
                    <div class="brand-btns">
                        <div class="google-btn">
                            <button type="submit" class="btn" id="google">
                                <img src="{{ asset('assets/web/images/google.png') }}" width="18px" height="18px">
                                <span> Google </span>
                            </button>
                        </div>
                        <div class="fcbk-btn">
                            <button type="submit" class="btn" id="facebook">
                                <img src="{{ asset('assets/web/images/facebook.svg') }}" width="25px" height="25px">
                                <span> Facebook </span>
                            </button>
                        </div>
                    </div>
                    <div class="copyright-txt">
                        <p>
                            By registering, you agree to the processing of your personal data by Salesforce as described in the Privacy Statement.
                        </p>
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
    var _token = $("input[name='_token']").val();
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
        },
        rules: {
            password: {
                required: true,
                minlength:8,
                maxlength:15
            },    
            confirm_password:{
                required: true,
                equalTo: "#password"
            },
            email:{
                "remote":
                {
                    url: "{{ route('web.checkEmail') }}",
                    type: "POST",
                    data: {
                        _token:_token,
                        email: function() {
                            return $("#email").val();
                        }
                    },
                }
            }
        },
        messages:{
            email:{
                required: "Please enter a valid email address.",
                remote: jQuery.validator.format("{0} is already exist.")
            }
        }
    });
});
</script>
@endsection