@extends('layouts.app')

@section('title', 'Form')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/form-wizard.css') }}">

@endsection

@section('content')
    <style>
        iframe > .quantumWizTextinputPaperinputInputArea{
            background-color: #0c2e60;
        }
    </style>

    <iframe src="https://docs.google.com/forms/d/e/1FAIpQLSeE2Ss_HKEm1eiWaiX5zJAic4dZvXS5xhoEjFPPrYOcJDWhBg/viewform?embedded=true"
            width="100%" height="730" frameborder="0" marginheight="0" marginwidth="0">Loading...
    </iframe>

@endsection

@section('js')
    <script src="{{ asset('js/form-wizard.js') }}"></script>
@endsection