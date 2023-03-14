@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
    
    <div class="dashboard is-full-height">
        
        @include('layouts.sidebar')

        <div class="dashboard-main is-scrollable">
            <nav class="navbar is-fixed-top">
                <div class="navbar-brand navbar-end">
                    <v-search></v-search>
                </div>
            </nav>
            @yield('dashboard-main-content')
        </div>        
    </div>
@endsection

