@extends('layouts.app')

@section('judul','IOT Sistem Sensor')


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

@include('header.header')

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
        <a class="navbar-brand px-lg-3 px-1 mr-0" href="#">IOT Sistem Sensor DASHBOARD</a>
        <div class="ml-auto">
            <div class="navbar-nav flex-row navbar-icons">
                <div class="nav-item">
                    <button id="alerts-toggler" class="btn btn-link nav-link" title="Alerts" type="button" data-alerts="3" data-toggle="modal" data-target="#alertsModal">
                        <svg class="icon-sprite">
                            <use xlink:href="{{ asset('assets/images/icons-sprite.svg#alert') }}" />
                            <svg class="text-danger">
                                <use class="icon-dot" xlink:href="{{ asset('assets/images/icons-sprite.svg#icon-dot') }}" />
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
            @include('menu.menu')
            <!-- Side menu END -->
            <!-- Main content START -->
            <div id="main">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card p-2 mb-4">
                                <p>IOT SISTEM SENSOR DAHSBOARD</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <!-- Security system START -->
                            <div class="card lock" data-unit="switch-house-lock">
                                <div class="card-body d-flex flex-wrap">
                                    <svg class="icon-sprite icon-2x">
                                        <use xlink:href="{{ asset('assets/images/icons-sprite.svg#home') }}" />
                                        <use class="subicon-unlocked" xlink:href="{{ asset('assets/images/icons-sprite.svg#subicon-unlocked') }}" />
                                        <use class="subicon-locked" xlink:href="{{ asset('assets/images/icons-sprite.svg#subicon-locked') }}" />
                                    </svg>
                                    <div class="title-status">
                                        <h4>Security system</h4>
                                        <p class="status"><span class="arm"></span></p>
                                    </div>
                                    <label class="switch ml-auto">
                                        <input type="checkbox" id="switch-house-lock">
                                    </label>
                                </div>
                            </div>
                            <!-- Security system END -->
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <!-- Garage-doors START -->
                            <div class="card" data-unit="garage-doors-1">
                                <div class="card-body">
                                    <div class="d-flex flex-wrap mb-2">
                                        <svg class="icon-sprite icon-1x">
                                            <use class="glow" fill="url(#radial-glow)" xlink:href="{{ asset('assets/images/icons-sprite.svg#glow') }}" />
                                            <use xlink:href="{{ asset('assets/images/icons-sprite.svg#garage') }}" />
                                        </svg>
                                        <div class="title-status">
                                            <h5>Garage doors</h5>
                                            <p class="status text-danger">Close</p>
                                        </div>
                                        <div class="ml-auto timer-controls" data-controls="garage-doors-1">
                                            <button data-action="open" type="button" class="btn btn-secondary doors-control">Open</button>
                                            <button data-action="pause" type="button" class="btn btn-secondary doors-control">Pause</button>
                                            <button data-action="resume" type="button" class="btn btn-secondary doors-control">Resume</button>
                                            <button data-action="close" type="button" class="btn btn-secondary doors-control">Close</button>
                                        </div>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar progress-tiny timer" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="12"></div>
                                    </div>
                                    <div class="info-holder info-cb">
                                        <div data-toggle="popover-all" data-content="Element driven by javascript (countdown timer)." data-original-title="Progress indicator" data-placement="top" data-offset="0,-12"></div>
                                    </div>
                                </div>
                            </div>
                            <!-- Garage-doors END -->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-xl-4">
                            <!-- Interior lights  START -->
                            <form action="{{ route('post_data') }}" method="POST">
                                @csrf
                                <div class="card" data-unit-group="switch-lights">
                                    <div class="card-body">
                                        <h3 class="card-title">Lights</h3>
                                    </div>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item d-flex active" data-unit="switch-light-1">
                                            <svg class="icon-sprite">
                                                <use class="glow" fill="url(#radial-glow)" xlink:href="{{ asset('assets/images/icons-sprite.svg#glow') }}" />
                                                <use xlink:href="{{ asset('assets/images/icons-sprite.svg#bulb-eco') }}" />
                                            </svg>
                                            <h5>Ruang Tamu</h5>
                                            <div class="info-holder info-rb" style="right:40px;">
                                                <div data-toggle="popover-all" data-content="Checkbox element using localStorage to remember the last status." data-original-title="Switch ON/OFF" data-container="body" data-placement="top" data-offset="0,-6"></div>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex" data-unit="switch-light-2">
                                            <svg class="icon-sprite">
                                                <use class="glow" fill="url(#radial-glow)" xlink:href="{{ asset('assets/images/icons-sprite.svg#glow') }}" />
                                                <use xlink:href="{{ asset('assets/images/icons-sprite.svg#bulb-eco') }}" />
                                            </svg>
                                            <h5>Kamar Tidur</h5>
                                        </li>
                                        <li class="list-group-item d-flex" data-unit="switch-light-3">
                                            <svg class="icon-sprite">
                                                <use class="glow" fill="url(#radial-glow)" xlink:href="{{ asset('assets/images/icons-sprite.svg#glow') }}" />
                                                <use xlink:href="{{ asset('assets/images/icons-sprite.svg#bulb-eco') }}" />
                                            </svg>
                                            <h5>Teras</h5>
                                        </li>
                                    </ul>
                                    <div class="card-body">
                                        <div class="lights-controls" data-controls="switch-lights">
                                            <button data-action="all-on" type="submit" name="bt1" class="btn btn-primary lights-control" value="on">All <strong>ON</strong></button>
                                            <button data-action="all-off" type="submit" name="bt2" class="btn btn-secondary lights-control" value="off">All <strong>OFF</strong></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <!-- Interior lights  END -->
                        </div>

                        <div class="col-sm-12 col-md-6 col-xl-4">
                            <!-- Exterior lights  START -->
                            <h3 class="card-title my-3">Lights - selected</h3>
                            <div class="card" data-unit="switch-light-6">
                                <form action="{{ route('lampu_1') }}" method="POST">
                                    @csrf
                                    <div class="card-body d-flex flex-row justify-content-start">
                                        <svg class="icon-sprite">
                                            <use class="glow" fill="url(#radial-glow)" xlink:href="assets/images/icons-sprite.svg#glow" />
                                            <use xlink:href="assets/images/icons-sprite.svg#bulb-eco" />
                                        </svg>
                                        <h5>Ruang Tamu</h5>
                                        <label class="switch ml-auto">
                                            <button data-action="all-on" type="submit" name="rt" class="btn btn-primary lights-control" value="on"><strong>ON</strong></button>
                                        </label>
                                    </div>
                                </form>
                            </div>
                            <div class="card" data-unit="switch-light-7">
                                <form action="{{ route('lampu_1') }}" method="POST">
                                    @csrf
                                    <div class="card-body d-flex flex-row justify-content-start">
                                        <svg class="icon-sprite">
                                            <use class="glow" fill="url(#radial-glow)" xlink:href="assets/images/icons-sprite.svg#glow" />
                                            <use xlink:href="assets/images/icons-sprite.svg#bulb-eco" />
                                        </svg>
                                        <h5>Kamar Tidur</h5>
                                        <label class="switch ml-auto">
                                            <button data-action="all-on" type="submit" name="kt" class="btn btn-primary lights-control" value="on"><strong>ON</strong></button>
                                        </label>
                                    </div>
                                </form>
                            </div>
                            <div class="card" data-unit="switch-light-8">
                                <form action="{{ route('lampu_1') }}" method="POST">
                                    @csrf
                                    <div class="card-body d-flex flex-row justify-content-start">
                                        <svg class="icon-sprite">
                                            <use class="glow" fill="url(#radial-glow)" xlink:href="assets/images/icons-sprite.svg#glow" />
                                            <use xlink:href="assets/images/icons-sprite.svg#bulb-eco" />
                                        </svg>
                                        <h5>Teras</h5>
                                        <label class="switch ml-auto">
                                            <button data-action="all-on" type="submit" name="tr" class="btn btn-primary lights-control" value="on"><strong>ON</strong></button>
                                        </label>
                                    </div>
                                </form>
                            </div>
                            <!-- Exterior lights  END -->
                        </div>
                        <div class="col-sm-12 col-md-6 col-xl-4">
                            <!-- Appliances  START -->
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title">Appliances</h3>
                                </div>
                                <hr class="my-0">
                                <!-- Washing machine  START -->
                                <ul class="list-group borderless active" data-unit="wash-machine">
                                    <li class="list-group-item d-flex pb-0">
                                        <svg class="icon-sprite icon-1x">
                                            <use class="glow" fill="url(#radial-glow)" xlink:href="{{ asset('assets/images/icons-sprite.svg#glow') }}" />
                                            <use xlink:href="{{ asset('assets/images/icons-sprite.svg#wash-machine') }}" />
                                        </svg>
                                        <h5>Washing machine</h5>
                                        <p class="ml-auto status">ON</p>
                                    </li>
                                    <li class="list-group-item d-flex pt-0 pb-4">
                                        <p class="entry">Remaining time</p>
                                        <p id="wash-machine" class="ml-auto mb-0"></p>
                                    </li>
                                </ul>
                                <!-- Washing machine  END -->
                                <hr class="my-0">
                                <!-- Fridge  START -->
                                <ul class="list-group borderless active" data-unit="home-fridge">
                                    <li class="list-group-item d-flex pb-0">
                                        <svg class="icon-sprite icon-1x">
                                            <use class="glow" fill="url(#radial-glow)" xlink:href="{{ asset('assets/images/icons-sprite.svg#glow') }}" />
                                            <use xlink:href="{{ asset('assets/images/icons-sprite.svg#home-fridge') }}" />
                                        </svg>
                                        <h5>Fridge</h5>
                                        <p class="ml-auto status">ON</p>
                                    </li>
                                    <li class="list-group-item d-flex pt-0 pb-4">
                                        <p class="entry">Temperature</p>
                                        <p class="ml-auto mb-0">35<sup>°F</sup></p>
                                    </li>
                                </ul>
                                <!-- Fridge  END -->
                                <hr class="my-0">
                                <!-- TV  START -->
                                <ul class="list-group borderless" data-unit="tv-lcd">
                                    <li class="list-group-item d-flex">
                                        <svg class="icon-sprite icon-1x">
                                            <use class="glow" fill="url(#radial-glow)" xlink:href="assets/images/icons-sprite.svg#glow" />
                                            <use xlink:href="{{ asset('assets/images/icons-sprite.svg#tv-lcd') }}" />
                                        </svg>
                                        <h5>TV</h5>
                                        <p class="ml-auto status">OFF</p>
                                    </li>
                                </ul>
                                <!-- TV  END -->
                            </div>
                            <!-- Appliances  END -->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <!-- Camera 1  START -->
                            <div class="card active" data-unit="switch-camera-1">
                                <div class="card-img-top card-stream">
                                    <div class="embed-responsive embed-responsive-16by9">
                                        <video muted loop>
                                            <source src="assets/videos/street.mp4" type="video/mp4" />
                                            <source src="assets/videos/street.webm" type="video/webm" />
                                        </video>
                                        <div class="card-preloader">
                                            <div class="center-preloader d-flex align-items-center">
                                                <div class="spinners">
                                                    <div class="spinner01"></div>
                                                    <div class="spinner02"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-img-top card-stream off">
                                    <div class="embed-responsive embed-responsive-16by9">
                                        <h2 class="center-abs">OFF</h2>
                                    </div>
                                </div>
                                <div class="card-body d-flex">
                                    <svg class="icon-sprite">
                                        <use class="glow" fill="url(#radial-glow)" xlink:href="{{ asset('assets/images/icons-sprite.svg#glow') }}" />
                                        <use xlink:href="{{ asset('assets/images/icons-sprite.svg#camera') }}" />
                                    </svg>
                                    <h5>Outdoor front</h5>
                                    <label class="switch ml-auto checked">
                                        <input type="checkbox" id="switch-camera-1" checked>
                                    </label>
                                </div>
                            </div>
                            <!-- Camera 1  END -->
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <!-- Camera 2  START -->
                            <div class="card" data-unit="switch-camera-2">
                                <div class="card-img-top card-stream">
                                    <div class="embed-responsive embed-responsive-16by9">
                                        <video muted loop>
                                            <source src="assets/videos/room.mp4" type="video/mp4" />
                                            <source src="assets/videos/room.webm" type="video/webm" />
                                        </video>
                                        <div class="card-preloader">
                                            <div class="center-preloader d-flex align-items-center">
                                                <div class="spinners">
                                                    <div class="spinner01"></div>
                                                    <div class="spinner02"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-img-top card-stream off">
                                    <div class="embed-responsive embed-responsive-16by9">
                                        <h2 class="center-abs">OFF</h2>
                                    </div>
                                </div>
                                <div class="card-body d-flex">
                                    <svg class="icon-sprite">
                                        <use class="glow" fill="url(#radial-glow)" xlink:href="{{ asset('assets/images/icons-sprite.svg#glow') }}" />
                                        <use xlink:href="{{ asset('assets/images/icons-sprite.svg#camera') }}" />
                                    </svg>
                                    <h5>kamar tidur</h5>
                                    <label class="switch ml-auto">
                                        <input type="checkbox" id="switch-camera-2">
                                    </label>
                                </div>
                            </div>
                            <!-- Camera 2  END -->
                        </div>
                    </div>
                    <br><br>
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
@endsection