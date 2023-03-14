@extends('layouts.dashboard')
@section('title', $survey->name)
@section('dashboard-main-content')
    <section class="section">
        <table class="table is-fullwidth table-evaluation">
            <thead>
                <th>{{ $survey->name }}</th>
            </thead>
        </table>
        <hr>
        <v-survey :survey="{{$survey}}"></v-survey>
</section>
@endsection
