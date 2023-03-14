@extends('layouts.dashboard')
@section('title', 'Organigrama')
@section('header_style')
    <link rel="stylesheet" href="/bp/demo/js/jquery/ui-lightness/jquery-ui-1.10.2.custom.css" />
    <script type="text/javascript" src="/bp/demo/js/jquery/jquery-1.9.1.js"></script>
    <script type="text/javascript" src="/bp/demo/js/jquery/jquery-ui-1.10.2.custom.js"></script>
    <style>        
        section {
            width: 100%;
            height: 100%;
            padding: 20px !important;
        }
        .iframe{
            width: 100%;
            height: 100%;
        }
    </style>

@endsection
@section('dashboard-main-content')
    <section class="section">
        <iframe id="content" width="100%" height="100%" src="{{$route}}" >
        </iframe>
    </section>    
@endsection


@section('javascript')
<script>
    jQuery(document).ready(function () {
        jQuery("#combobox").change(function () {
            jQuery("#content").attr('src', jQuery("#combobox").val());
        });
    });
</script>
@endsection
