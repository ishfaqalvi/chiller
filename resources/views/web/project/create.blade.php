@extends('web.layout.app')

@section('title')
    ChillerWise | New Project
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
        <form method="POST" action="{{ route('project.store') }}" id="validate">
            @csrf
            <div class="chiler-name">
                <label>NUMBER OF CHILLERS</label><br>
                <select id="numberOfChiller" class="field-one" name="number_of_chillers" required>
                    <option value="1" {{ $chiller == 1 ? 'selected' : ''}}>1</option>
                    <option value="2" {{ $chiller == 2 ? 'selected' : ''}}>2</option>
                    <option value="3" {{ $chiller == 3 ? 'selected' : ''}}>3</option>
                    <option value="4" {{ $chiller == 4 ? 'selected' : ''}}>4</option>
                    <option value="5" {{ $chiller == 5 ? 'selected' : ''}}>5</option>
                </select>
                {{-- <input type="text" id="" name=""> --}}
            </div>
            <div class="form-fieldwrap d-flex">
                <div class="field-one">
                    <label>BUILDING/FACILITY MINIMUM LOAD (KWR)</label>
                    <input type="number" name="building_minimum_load" required min="0">
                </div>
                <div class="field-two">
                    <label>BUILDING/FACILITY MAXIMUM LOAD (KWR)</label>
                    <input type="number" name="building_maximum_load" required min="0">
                </div>
                <div class="field-three">
                    <label>CHILLED WATER DIFFERENTIAL (DEG C)</label>
                    <input type="number" name="chilled_water_differential" required min="0">
                </div>
            </div>
            @for ($i = 1; $i <= $chiller; $i++)
                <div class="chiller-one">
                    <h6>{{ 'CHILLER '.$i }}</h6>
                    <label>SELECT CHILLER FROM LIST</label><br>
                    <select class="field-one chiller-select" name="chiller_id[{{ $i }}]" data-index="{{ $i }}">
                        <option value="">--Select--</option>
                        @foreach (chillers() as $row)
                            <option
                                value="{{ $row->id }}"
                                data-cmaxc="{{ $row->chiller_maximum_capacity }}"
                                data-cminc="{{ $row->chiller_minimum_capacity }}"
                                data-cwf="{{ $row->chilled_water_flow }}"
                                data-pl25="{{ $row->partial_load_25 }}"
                                data-pl50="{{ $row->partial_load_50 }}"
                                data-pl75="{{ $row->partial_load_75 }}"
                                data-pl100="{{ $row->partial_load_100 }}"
                                >
                                {{ $row->name }} ({{ $row->model->name }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-fieldwrap d-flex">
                    <div class="field-one">
                        <label>CHILLER MAXIMUM CAPACITY (KWR)</label>
                        <input type="number" class="max-capacity-{{ $i }}" name="chiller_maximum_capacity[{{ $i }}]" readonly>
                    </div>
                    <div class="field-two">
                        <label>CHILLER MINIMUM CAPACITY (KWR)</label>
                        <input type="number" class="min-capacity-{{ $i }}" name="chiller_minimum_capacity[{{ $i }}]" readonly>
                    </div>
                    <div class="field-three">
                        <label>CHILLED WATER FLOW (L/S)</label>
                        <input type="number" class="water-flow-{{ $i }}" name="chilled_water_flow[{{ $i }}]" readonly>
                    </div>
                </div>
                <div class="partial-input">
                    <p>PARTIAL LOAD</p>
                    <div class="form-fieldwrap d-flex">
                        <div class="field-one input-width">
                            <label>IPLV (25%)</label>
                            <input type="number" class="pl25-{{ $i }}" name="partial_load_25[{{ $i }}]" readonly>
                        </div>
                        <div class="field-two input-width">
                            <label>IPLV (50%)</label>
                            <input type="number" class="pl50-{{ $i }}" name="partial_load_50[{{ $i }}]" readonly>
                        </div>
                        <div class="field-three input-width">
                            <label>IPLV (75%)</label>
                            <input type="number" class="pl75-{{ $i }}" name="partial_load_75[{{ $i }}]" readonly>
                        </div>
                        <div class="field-four input-width">
                            <label>IPLV (100%)</label>
                            <input type="number" class="pl100-{{ $i }}" name="partial_load_100[{{ $i }}]" readonly>
                        </div>
                    </div>
                </div>
            @endfor
            <div class="calculte-btn">
                <button type="submit" class="cal-btn">Calculate</button>
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

        var numChillers = parseInt("{{ $chiller }}", 10);
        for (var i = 1; i <= numChillers; i++) {
            var suffix = '[' + i + ']';
            validator.settings.rules['chiller_id' + suffix] = { required: true};
            validator.settings.rules['chiller_maximum_capacity' + suffix] = { required: true, number: true };
            validator.settings.rules['chiller_minimum_capacity' + suffix] = { required: true, number: true };
            validator.settings.rules['chilled_water_flow' + suffix] = { required: true, number: true };
            validator.settings.rules['partial_load_25' + suffix] = { required: true, number: true };
            validator.settings.rules['partial_load_50' + suffix] = { required: true, number: true };
            validator.settings.rules['partial_load_75' + suffix] = { required: true, number: true };
            validator.settings.rules['partial_load_100' + suffix] = { required: true, number: true };
        }
    }
    $(document).ready(function() {
        applyValidation();
        $('#numberOfChiller').on('change', function() {
            var number = $(this).val();
            $.ajax({
                url: "{{ route('project.setChiller') }}",
                type: 'POST',
                data: { number: number},
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    window.location.href = "{{ route('project.create') }}";
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('.chiller-select').on('change', function() {
            var index = $(this).data('index');
            var selectedOption = $(this).find('option:selected');
            $('.max-capacity-' + index).val(selectedOption.data('cmaxc') || '');
            $('.min-capacity-' + index).val(selectedOption.data('cminc') || '');
            $('.water-flow-' + index).val(selectedOption.data('cwf') || '');
            $('.pl25-' + index).val(selectedOption.data('pl25') || '');
            $('.pl50-' + index).val(selectedOption.data('pl50') || '');
            $('.pl75-' + index).val(selectedOption.data('pl75') || '');
            $('.pl100-' + index).val(selectedOption.data('pl100') || '');
        });
    });
</script>
@endsection
