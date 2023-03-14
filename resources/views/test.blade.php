@extends('layouts.app')
@section('content')
    <div class="dashboard is-full-height">
        <!-- left panel -->
        <div class="dashboard-panel is-one-quarter">
        </div>

        <!-- main section -->
        <div class="dashboard-main is-scrollable">
            <nav class="navbar is-fixed-top">
                <div class="navbar-brand">
                    <span class="navbar-item">
                        Bulma Dashbaord
                    </span>
                </div>
            </nav>

            <section class="section">
                <p class="title">
                    Main
                </p>
            </section>

            <!-- the footer will take up all unused space at the bottom -->
            <footer class="footer">

            </footer>
        </div>

        <!-- right panel -->
        <div class="dashboard-panel is-small">
        </div>
    </div>
@endsection
