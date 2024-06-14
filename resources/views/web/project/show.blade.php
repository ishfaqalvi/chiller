@extends('web.layout.app')

@section('title')
    ChillerWise | Project List
@endsection

@section('head')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/web/css/calculator-app-1.css') }}">
@endsection

@section('content')
    <section>
        <img src="{{ asset('assets/web/images/industry-factory.png') }}" alt="banner img" width="100%" height="auto">
    </section>
    <section id="section-template--10" class="page-width">
        <div class="wrapper-content">
            <h2>GREAT NEWS!</h2>
            <p>Your chiller optimization calculations are now complete.</p>
            <p>
                We’ve analyzed the data you provided and generated precise calculations tailored to your specific needs. Our advanced algorithms have determined the optimal combination of chillers for each load step, ensuring maximum efficiency and cost savings for your chiller operations.
            </p>
        </div>
        <div>
            <a href="{{ route('project.calculate', $project->id) }}" class="button button--primary">DOWNLOAD RESULTS</a>
        </div>
    </section>
@endsection
