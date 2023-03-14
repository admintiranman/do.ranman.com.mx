@extends('layouts.dashboard')
@section('title', $evControl->name)
@section('dashboard-main-content')
    @include('ev_control.partial.showControl', compact('users', 'evControl'))
@endsection