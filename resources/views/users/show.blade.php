@extends('layouts.dashboard')
@section('title', $user->name ?? '404 Not found')
@section('header_style')
<style>
    .modal-card {
        width:90%;
        height: 720px;
    }
</style>
@endsection
@section('dashboard-main-content')
    <section class="section">
        <v-modal-job is_admin="{{ $user->hasRole('Administrador') }}" job_id="{{ $user->job->id }}"
            name="{{ $user->name }}" job="{{ $user->job->name }}"></v-modal-job>
        @if ($user->boss)
            <p class="subtitle is-5 is-spaced">
                Supervisado por {{ $user->boss->name }}
            </p>
            <hr>
        @endif
        <div class="tabs is-centered is-boxed">
            <ul>
                <li @if($tab == 'objetivos') class="is-active" @endif >
                    <a @if($tab != 'objetivos') href="?tab=objetivos" @endif>
                        <span class="icon is-small"><i class="fas fa-file-pdf" aria-hidden="true"></i></span>
                        <span>Objetivos</span>
                    </a>
                </li>
                <li @if($tab == 'pdi') class="is-active" @endif>
                    <a @if($tab != 'pdi') href="?tab=pdi" @endif>
                        <span class="icon is-small"><i class="far fa-file-alt" aria-hidden="true"></i></span>
                        <span>Plan de desarrollo individual</span>
                    </a>
                </li>
                @if ($user->team->count() > 0)
                    <li @if($tab == 'team') class="is-active" @endif>
                        <a @if($tab != 'team') href="?tab=team" @endif>
                            <span class="icon is-small"><i class="fas fa-users" aria-hidden="true"></i></span>
                            <span>Equipo</span>
                        </a>
                    </li>
                @endif
            </ul>
        </div>

        @switch($tab)
            @case("objetivos")
                @include('objectives.index', $user)        
            @break
            @case("pdi")
                @include('pdi.index', $user)        
            @break
            @case("team")
                @if ($user->team->count() > 0)
                    @include('team.index')
                @endif
            @break
            @default
                    <p class="subtitle is-4">
                        404 :(  
                    </p>                
        @endswitch
    </section>
@endsection
