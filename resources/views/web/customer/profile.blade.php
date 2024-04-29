@extends('web.layout.app')

@section('title')
    ChillerWise | Profile
@endsection

@section('head')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/web/css/profile.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/web/css/signup.css') }}">
@endsection

@section('content')
@php($customer = auth('customers')->user())
<section id="profile-section">
    <div class="page-width profile-sec">
        <div class="wrapper-container">
            <div class="row profle-wrap">
                <div class="col-lg-4 col-md-12 col-sm-12 welcom-back">
                    <div class="welcomeback-text">
                        <p>Welcome Back</p>
                        <h4>{{ $customer->first_name.' '. $customer->last_name }}</h4>
                    </div>
                    <div class="new-project">
                        <a href="{{ route('project.create') }}"><h4>NEW PROJECT</h4></a>
                        <a href="{{ route('project.index') }}"><h4>VIEW PAST PROJECT</h4></a>
                        <h4>TAX INVOICES</h4>
                        <a href="{{ route('chiller.create') }}"><h4>NEW CHILLER Request</h4></a>
                    </div>
                </div>
                <div class="col-lg-8 col-md-12 col-sm-12 profile-content">
                    <h4>Profile</h4>
                    <div class="account-wrap">
                        <div class="account-left">
                            <h6>ACCOUNT DETAILS</h6>
                            <div class="txt-wrap">
                                <div class="heading">
                                    <strong>Name : </strong>
                                </div>
                                <div class="value">
                                    <span>{{ $customer->first_name.' '. $customer->last_name }}</span>
                                </div>
                            </div>
                            <div class="txt-wrap">
                                <div class="heading">
                                    <strong>Email :</strong>
                                </div>
                                <div class="value">
                                    <span>{{ $customer->email }}</span>
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
                            @if($customer->billingInfo)
                            <p><strong>Street Address :</strong> {{ $customer->billingInfo->street_address }}</p>
                            <p><strong>City :</strong> {{ $customer->billingInfo->city }}</p>
                            <p><strong>Province :</strong> {{ $customer->billingInfo->province }}</p>
                            <p><strong>Zip Code :</strong> {{ $customer->billingInfo->zip_code }}</p>
                            <p><strong>Country :</strong> {{ $customer->billingInfo->country }}</p>
                            <p><strong>Phone # :</strong> {{ $customer->billingInfo->phone_number }}</p>
                            @endif
                        </div>
                        <div class="account-right">
                            <a href="#" class="btn" data-toggle="modal" data-target="#updateBillingInfo">UPDATE BILLING INFO</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="updateProfile" tabindex="-1" aria-labelledby="propernameLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form class="mt-2" action="{{ route('customer.update') }}" method="POST" id="validate">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="propernameLabel">Update Your Account Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-lg-4">
                            <label for="fname">First Name</label>
                            <input type="text" class="form-control" id="fname" name="first_name" required value="{{ $customer->first_name }}">
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="lname">Last Name</label>
                            <input type="text" class="form-control" id="lname" name="last_name" required value="{{ $customer->last_name }}">
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required value="{{ $customer->email }}">
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="job">Job Title</label>
                            <select class="form-control" id="job" name="job_title" required>
                                <option value="">--Select--</option>
                                <option value="Job Title 1" {{ $customer->job_title == 'Job Title 1' ? 'selected' : '' }}>Job Title 1</option>
                                <option value="Job Title 2" {{ $customer->job_title == 'Job Title 2' ? 'selected' : '' }}>Job Title 2</option>
                                <option value="Job Title 3" {{ $customer->job_title == 'Job Title 3' ? 'selected' : '' }}>Job Title 3</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="company">Company</label>
                            <input type="text" class="form-control" id="company" name="company" required value="{{ $customer->company }}">
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="mobile">Mobile #</label>
                            <input type="text" class="form-control" id="mobile" name="mobile_number" required value="{{ $customer->mobile_number }}">
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="employees">Employees</label>
                            <select class="form-control" id="employees" name="employees" required>
                                <option value="">--Select Employees--</option>
                                <option value="Employees 1" {{ $customer->employees == 'Employees 1' ? 'selected' : '' }}>Employees 1</option>
                                <option value="Employees 2" {{ $customer->employees == 'Employees 2' ? 'selected' : '' }}>Employees 2</option>
                                <option value="Employees 3" {{ $customer->employees == 'Employees 3' ? 'selected' : '' }}>Employees 3</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="profileCountry">Country</label>
                            <select class="form-control" id="profileCountry" name="country" required>
                                <option value="">--Select Country--</option>
                                <option value="Country 1" {{ $customer->country == 'Country 1' ? 'selected' : '' }}>Country 1</option>
                                <option value="Country 2" {{ $customer->country == 'Country 2' ? 'selected' : '' }}>Country 2</option>
                                <option value="Country 3" {{ $customer->country == 'Country 3' ? 'selected' : '' }}>Country 3</option>
                            </select>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="form-group col-lg-4">
                            <label for="oldpassword">Old Password</label>
                            <input type="password" class="form-control" id="oldpassword" name="old_password" required>
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="confirm_password">Confirm Password</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="updateBillingInfo" tabindex="-1" aria-labelledby="propernameLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form class="mt-2" action="{{ route('customer.billing.info') }}" method="POST" id="validateBillingInfo">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="propernameLabel">Update Your Billing Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-lg-6 mb-3">
                            {{ Form::label('street_address') }}
                            {{ Form::text('street_address', @$customer->billingInfo->street_address, ['class' => 'form-control', 'placeholder' => 'Street Address','required']) }}
                        </div>
                        <div class="form-group col-lg-6 mb-3">
                            {{ Form::label('city') }}
                            {{ Form::text('city', @$customer->billingInfo->city, ['class' => 'form-control', 'placeholder' => 'City','required']) }}
                        </div>
                        <div class="form-group col-lg-6 mb-3">
                            {{ Form::label('province') }}
                            {{ Form::text('province', @$customer->billingInfo->province, ['class' => 'form-control', 'placeholder' => 'Province','required']) }}
                        </div>
                        <div class="form-group col-lg-6 mb-3">
                            {{ Form::label('zip_code') }}
                            {{ Form::text('zip_code', @$customer->billingInfo->zip_code, ['class' => 'form-control', 'placeholder' => 'Zip Code','required']) }}
                        </div>
                        <div class="form-group col-lg-6 mb-3">
                            {{ Form::label('country') }}
                            {{ Form::text('country', @$customer->billingInfo->country, ['class' => 'form-control', 'placeholder' => 'Country','required']) }}
                        </div>
                        <div class="form-group col-lg-6 mb-3">
                            {{ Form::label('phone_number') }}
                            {{ Form::text('phone_number', @$customer->billingInfo->phone_number, ['class' => 'form-control', 'placeholder' => 'Phone Number','required']) }}
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
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
                            id:"{{ auth('customers')->user()->id }}",
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
        $("#validateBillingInfo").validate({
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
