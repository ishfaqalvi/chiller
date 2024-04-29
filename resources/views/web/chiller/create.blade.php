@extends('web.layout.app')

@section('title')
    ChillerWise | New Chiller Request
@endsection

@section('head')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/web/css/profile.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/web/css/calculator-app.css') }}">
@endsection

@section('content')
<section id="calculator-section">
    <div class="page-width claculator-sec">
        <div class="wrapper-container">
            <div class="row">
                <div class="col-12">
                    <div class="app-banner-sec">
                        <div class="app-banner-wrap">
                            <div class="app-icon">
                                <img src="{{ asset('assets/web/images/app-icon.png') }}">
                            </div>
                            <div class="banner-txt">
                                <p>Optimize chiller operations with the ChillerWise Calculator. Our all-in-one solution eliminates guesswork, ensuring maximum efficiency and cost savings. Enter your chiller information and specific needs in our user-friendly interface. Advanced algorithms generate precise calculations for optimal performance at each load step. Consider factors like chiller performance, load conditions, and energy consumption. Make informed decisions and enhance efficiency with comprehensive insights. Streamline your operations and achieve significant energy savings as a mechanical engineer, facility manager, or chiller operator. Experience data-driven chiller optimization with ChillerWise. Start now and unlock efficiency for your operations.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="app-banner-img">
        <img src="{{ asset('assets/web/images/calculator-banerimg.png') }}">
    </div>
</section>
<section id="calculator-form">
    <div class="wrapper-container">
        <form method="POST" action="{{ route('chiller.store') }}" id="validate">
            @csrf
            <div class="form-fieldwrap d-flex">
                <div class="field-one">
                    <label>NAME OF CHILLER</label><br>
                    <input type="text" id="" name="name" required>
                </div>
                <div class="field-two">
                    <label>MODEL OF CHILLER</label><br>
                    <input type="text" id="" name="model" required>
                </div>
            </div>
            <div class="chiller-one">
                <h6>CHILLER DETAIL</h6>
            </div>
            <div class="form-fieldwrap d-flex">
                <div class="field-one">
                    <label>CHILLER MAXIMUM CAPACITY (KWR)</label>
                    <input type="number" id="" name="chiller_maximum_capacity" required>
                </div>
                <div class="field-two">
                    <label>CHILLER MINIMUM CAPACITY (KWR)</label>
                    <input type="number" id="" name="chiller_minimum_capacity" required>
                </div>
                <div class="field-three">
                    <label>CHILLED WATER FLOW (L/S)</label>
                    <input type="number" id="" name="chilled_water_flow" required>
                </div>
            </div>
            <div class="partial-input">
                <p>PARTIAL LOAD</p>
                <div class="form-fieldwrap d-flex">
                    <div class="field-one input-width">
                        <label>IPLV (25%)</label>
                        <input type="number" name="partial_load_25" required>
                    </div>
                    <div class="field-two input-width">
                        <label>IPLV (50%)</label>
                        <input type="number" name="partial_load_50" required>
                    </div>
                    <div class="field-three input-width">
                        <label>IPLV (75%)</label>
                        <input type="number" name="partial_load_75" required>
                    </div>
                    <div class="field-four input-width">
                        <label>IPLV (100%)</label>
                        <input type="number" name="partial_load_100" required>
                    </div>
                </div>
            </div>
            <div class="calculte-btn">
                <button type="submit" class="cal-btn">Submit</button>
            </div>
        </form>
    </div>
</section>
@endsection

@section('script')
<script type="text/javascript">
    function applyValidation() {
        var validator = $('#validate').validate({
            ignore: [],
            rules: {},
            messages: {},
            errorClass: 'invalid',
            successClass: 'success',
            validClass: 'success',
            errorElement: 'span',
            errorClass: 'error',
            highlight: function(element) {
                $(element).removeClass('success').addClass('invalid');
            },
            unhighlight: function(element) {
                $(element).removeClass('invalid').addClass('success');
            },
            errorPlacement: function(error, element) {
                error.insertAfter(element);
            }
        });
    }
    applyValidation();
</script>
@endsection
