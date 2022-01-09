@extends('layouts.app')


@section('judul','data suhu')


@section('konten')
<!-- Preloader -->
<div id="iot-preloader">
    <div class="center-preloader d-flex align-items-center">
        <div class="spinners">
            <div class="spinner01"></div>
            <div class="spinner02"></div>
        </div>
    </div>
</div>

<!-- Alerts Modal -->
<div class="modal modal-nobg centered fade" id="alertsModal" tabindex="-1" role="dialog" aria-label="Alerts" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="alert alert-danger alert-dismissible fade show border-0" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button> Security SW update available
                </div>
                <div class="alert alert-warning alert-dismissible fade show border-0" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button> New device recognized
                </div>
                <div class="alert alert-warning alert-dismissible fade show border-0" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button> User profile is not complete
                </div>
            </div>
        </div>
    </div>
    <button type="button" class="close close-modal" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<!-- Alarm Modal -->
<div class="modal modal-danger centered fade" id="alarmModal" tabindex="-1" role="dialog" aria-label="ALARM" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content" data-dismiss="modal">
            <div class="modal-body d-flex">
                <svg class="icon-sprite icon-2x icon-pulse">
                    <use xlink:href="{{ asset('assets/images/icons-sprite.svg#alarm') }}" />
                </svg>
                <h3 class="text-right font-weight-bold ml-auto align-self-center">MOTION DETECTED!</h3>
            </div>
        </div>
        <p class="mt-2 text-center text-danger">Click the red area to accept/close message</p>
    </div>
</div>

<!-- Wrapper START -->
<div id="wrapper" class="hidden">
    <!-- Top navbar START -->
    <nav class="navbar navbar-expand fixed-top d-flex flex-row justify-content-start">
        <div class="d-none d-lg-block">
            <form>
                <div id="menu-minifier">
                    <label>
                        <svg width="32" height="32" viewBox="0 0 32 32">
                            <rect x="2" y="8" width="4" height="3" class="menu-dots"></rect>
                            <rect x="2" y="15" width="4" height="3" class="menu-dots"></rect>
                            <rect x="2" y="22" width="4" height="3" class="menu-dots"></rect>
                            <rect x="8" y="8" width="21" height="3" class="menu-lines"></rect>
                            <rect x="8" y="15" width="21" height="3" class="menu-lines"></rect>
                            <rect x="8" y="22" width="21" height="3" class="menu-lines"></rect>
                        </svg>
                        <input id="minifier" type="checkbox">
                    </label>
                    <div class="info-holder info-rb">
                        <div data-toggle="popover-all" data-content="Checkbox element using localStorage to remember the last status." data-original-title="Side menu narrowing" data-placement="right"></div>
                    </div>
                </div>
            </form>
        </div>
        <a class="navbar-brand px-lg-3 px-1 mr-0" href="#">IOT Sistem Sensor</a>
        <div class="ml-auto">
            <div class="navbar-nav flex-row navbar-icons">
                <div class="nav-item">
                    <button id="alerts-toggler" class="btn btn-link nav-link" title="Alerts" type="button" data-alerts="3" data-toggle="modal" data-target="#alertsModal">
                        <svg class="icon-sprite">
                            <use xlink:href="{{ asset('assets/images/icons-sprite.svg#alert') }}" />
                            <svg class="text-danger">
                                <use class="icon-dot" xlink:href="assets/images/icons-sprite.svg#icon-dot" />
                            </svg>
                        </svg>
                    </button>
                </div>
                <div id="user-menu" class="nav-item dropdown">
                    <button class="btn btn-link nav-link dropdown-toggle" title="User" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <svg class="icon-sprite">
                            <use xlink:href="{{ asset('assets/images/icons-sprite.svg#user') }}" />
                        </svg>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="profile.html">Profile</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="login.html">Logout</a>
                    </div>
                </div>
                <div class="nav-item d-lg-none">
                    <button id="sidebar-toggler" type="button" class="btn btn-link nav-link" data-toggle="offcanvas">
                        <svg class="icon-sprite">
                            <use xlink:href="{{ asset('assets/images/icons-sprite.svg#menu') }}" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>
    <!-- Top navbar END -->
    <!-- wrapper-offcanvas START -->
    <div class="wrapper-offcanvas">
        <!-- row-offcanvas START -->
        <div class="row-offcanvas row-offcanvas-left">
            <!-- Side menu START -->
            @include('menu.menu')
            <!-- Side menu END -->
            <!-- Main content START -->
            <div id="main">
                <div class="container-fluid">
                    <div class="row">
                        <!-- Appliances  START -->
                        <div class="col-sm-12 col-md-6">
                            <!-- Living room temperature  START -->
                            <div class="card temp-range heating" data-unit="room-temp-02">
                                <ul class="list-group borderless">
                                    <li class="list-group-item align-items-center">
                                        <svg class="icon-sprite icon-1x">
                                            <use xlink:href="{{ asset('assets/images/icons-sprite.svg#thermometer-tiny') }}" />
                                        </svg>
                                        <h5>Kamar Tidur</h5>
                                        <h5 class="ml-auto status">{{ $suhu }}<sup>°C</sup></h5>
                                    </li>
                                </ul>
                                <hr class="my-0">
                                <div class="d-flex justify-content-between" data-rangeslider="room-temp-02">
                                    <ul class="list-group borderless px-1 align-items-stretch">
                                        <li class="list-group-item">
                                            <p class="specs mr-auto mb-auto">Temperatur rumah saat ini</p>
                                        </li>
                                        <li class="list-group-item d-flex flex-column pb-4">
                                            <p class="mr-auto mt-2 mb-0 display-5">
                                                <span class="room-temp-F">{{ $suhu }}</span><sup>°C</sup>
                                            </p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Living room temperature  END -->
                        </div>
                        <!-- Outdoor temperature END -->
                        <!-- Appliances  END -->
                    </div>
                    <!-- Main content overlay when side menu appears  -->
                    <div class="cover-offcanvas" data-toggle="offcanvas"></div>
                </div>
                <!-- Main content END -->
            </div>
            <!-- row-offcanvas END -->
        </div>
        <!-- wrapper-offcanvas END -->
    </div>
    <!-- Wrapper END -->

    <!-- FAB button - bottom right on large screens -->
    <button id="info-toggler" type="button" class="btn btn-primary btn-fab btn-fixed-br d-none d-lg-inline-block">
        <svg class="icon-sprite">
            <use xlink:href="{{ asset('assets/images/icons-sprite.svg#info') }}" />
        </svg>
    </button>

    <!-- SVG assets - not visible -->
    <svg id="svg-tool" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
        <defs>
            <style type="text/css">
                .glow circle {
                    fill: url(#radial-glow)
                }
            </style>
            <filter id="blur" x="-25%" y="-25%" width="150%" height="150%">
                <feGaussianBlur in="SourceGraphic" stdDeviation="3" />
            </filter>
            <radialGradient id="radial-glow" fx="50%" fy="50%" r="50%">
                <stop offset="0" stop-color="#0F9CE6" stop-opacity="1" />
                <stop offset="1" stop-color="#0F9CE6" stop-opacity="0" />
            </radialGradient>
        </defs>
    </svg>


    @endsection