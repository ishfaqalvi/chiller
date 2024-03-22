@extends('web.layout.app')

@section('title')
    ChillerWise | Profile
@endsection

@section('head')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/web/css/profile.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/web/css/signup.css') }}">
@endsection

@section('content')
<section id="profile-section">
    <div class="page-width profile-sec">
        <div class="wrapper-container">
            <div class="row profle-wrap">
                <div class="col-lg-4 col-md-12 col-sm-12 welcom-back">
                    <div class="welcomeback-text">
                        <p>Welcome Back</p>
                        <h4>Name</h4>
                    </div>
                    <div class="new-project">
                        <h4>NEW PROJECT</h4>
                        <h4>VIEW PAST PROJECTS</h4>
                        <h4>TAX INVOICES</h4>
                    </div>
                </div>
                <div class="col-lg-8 col-md-12 col-sm-12 profile-content">
                    <h4>Profile</h4>
                    <div class="account-wrap">
                        <div class="account-left">
                            <h6>ACCOUNT DETAILS</h6>
                            <div class="txt-wrap">
                                <div class="heading"> <strong>Username</strong> </div> 
                                <div class="value"><span>Username</span> </div>
                            </div>
                            <div class="txt-wrap">
                                <div class="heading">
                                    <strong>Name</strong> 
                                </div>
                                <div class="value">
                                    <span>{{ auth('customers')->user()->first_name.' '. auth('customers')->user()->last_name }}</span> 
                                </div>
                            </div>
                            <div class="txt-wrap">
                                <div class="heading">
                                    <strong>Email</strong> 
                                </div>
                                <div class="value">
                                    <span>{{ auth('customers')->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="account-right">
                            <a href="#" class="btn" data-toggle="modal" data-target="#updateProfile">UPDATE ACCOUNT DETAILS</a>
                        </div>
                    </div>
                    <div class="account-wrap">
                        <div class="account-left">
                            <h6>BILLING INFORMATION</h6>
                            <p>192 Micheal Shoals</p>
                            <p>Stantonview </p>
                            <p>West Virginia</p>
                            <p>USA</p>
                            <p>90503-3206</p>
                        </div>
                        <div class="account-right">
                            <button type="button" class="btn" id="update">UPDATE BILLING INFORMATION</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="popup" class="popup">
        <div class="popup-content">
            <div class="login-form signup-form">
                <button id="closeBtn">Close</button>
                <h4></h4>
                
                    
                    <div class="sign-btn">
                        <button type="submit" class="btn" id="sign" value="Sign in">Start</button>
                    </div>
                
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="updateProfile" tabindex="-1" aria-labelledby="propernameLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            @php($user = auth('customers')->user())
            <form class="mt-2" action="{{ route('customer.update') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="propernameLabel">Update Your Account Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-field-wrap">
                        <div class="fname-field">
                            <input type="text" placeholder="Eureka" id="fname" name="first_name" required value="{{ $user->first_name }}">
                        </div>
                        <div class="lname-field">
                            <input type="text" placeholder="Seken" id="lname" name="last_name" required value="{{ $user->last_name }}">
                        </div>
                    </div>
                    <div class="form-field-wrap">
                        <div class="email-field">
                            <input type="email" placeholder="Email" id="email" name="email" required value="{{ $user->email }}">
                        </div>
                        <div class="job-field">
                            <select class="job-select" id="job" name="job_title" required>
                                <option value="">--Select--</option>
                                <option value="Job Title 1" {{ $user->job_title == 'Job Title 1' ? 'selected' : '' }}>Job Title 1</option>
                                <option value="Job Title 2" {{ $user->job_title == 'Job Title 2' ? 'selected' : '' }}>Job Title 2</option>
                                <option value="Job Title 3" {{ $user->job_title == 'Job Title 3' ? 'selected' : '' }}>Job Title 3</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-field-wrap">
                        <div class="email-field">
                            <input type="password" placeholder="Password" id="password" name="password">
                        </div>
                        <div class="email-field">
                            <input type="password" placeholder="Confirm Password" id="confirm_password" name="confirm_password">
                        </div>
                    </div>
                    <div class="form-field-wrap">
                        <div class="comapny-field">
                            <input type="text" placeholder="Company" id="company" name="company" required value="{{ $user->company }}">
                        </div>
                        <div class="mobile-field">
                            <input type="text" placeholder="Mobile" id="mobile" name="mobile_number" required value="{{ $user->mobile_number }}">
                        </div>
                    </div>
                    <div class="form-field-wrap">
                        <div class="employe-field">
                            <select class="employe-select" id="employees" name="employees" required>
                                <option value="">--Select Employees--</option>
                                <option value="Employees 1" {{ $user->employees == 'Employees 1' ? 'selected' : '' }}>Employees 1</option>
                                <option value="Employees 2" {{ $user->employees == 'Employees 2' ? 'selected' : '' }}>Employees 2</option>
                                <option value="Employees 3" {{ $user->employees == 'Employees 3' ? 'selected' : '' }}>Employees 3</option>
                            </select>
                        </div>
                        <div class="country-field">
                            <select class="country-select" id="country" name="country" required>
                                <option value="">--Select Country--</option>
                                <option value="Country 1" {{ $user->country == 'Country 1' ? 'selected' : '' }}>Country 1</option>
                                <option value="Country 2" {{ $user->country == 'Country 2' ? 'selected' : '' }}>Country 2</option>
                                <option value="Country 3" {{ $user->country == 'Country 3' ? 'selected' : '' }}>Country 3</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
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