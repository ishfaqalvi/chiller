@extends('web.layout.app')

@section('title')
    ChillerWise | Project List
@endsection

@section('head')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/web/css/profile.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/web/css/view-download.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/web/css/tax-invoice.css') }}">
@endsection

@section('content')
@php($customer = auth('customers')->user())
<section id="profile-section">
    <div class="page-width profile-sec">
        <div class="wrapper-container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12 welcom-back">
                    <div class="welcomeback-text">
                        <p>Welcome Back</p>
                        <h4>{{ $customer->first_name.' '. $customer->last_name }}</h4>
                    </div>
                    <div class="new-project">
                        <a href="{{ route('projects.create') }}"><h4>NEW PROJECT</h4></a>
                        <a href="{{ route('projects.index') }}"><h4>VIEW PAST PROJECT</h4></a>
                        <h4>TAX INVOICES</h4>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-12 profile-content">
                    <h4>PAST PROJECTS</h4>
                    <div class="download-wrap">
                        <div class="account-left">
                            <div class="inner-wrap">
                                <div class="inner-left">
                                    <h6>Date</h6>
                                    <p>MM/DD/YYYY</p>
                                    <p>MM/DD/YYYY</p>
                                    <p>MM/DD/YYYY</p>
                                    <p>MM/DD/YYYY</p>
                                    <p>MM/DD/YYYY</p>
                                </div>
                                <div class="inner-right">
                                    <h6>PROJECT NUMBER</h6>
                                    <p>000000</p>
                                    <p>000000</p>
                                    <p>000000</p>
                                    <p>000000</p>
                                    <p>000000</p>
                                </div>
                            </div>
                        </div>
                        <div class="account-right">
                            <div class="inner-wrap">
                                <div class="inner-left">
                                    <h6>TOTAL AMOUNT</h6>
                                    <p>$0000.00</p>
                                    <p>$0000.00</p>
                                    <p>$0000.00</p>
                                    <p>$0000.00</p>
                                    <p>$0000.00</p>
                                </div>
                                <div class="inner-right">
                                    <h6 style="visibility: hidden;">File</h6>
                                    <p> file </p>
                                    <p> file </p>
                                    <p> file </p>
                                    <p> file </p>
                                    <p> file </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
