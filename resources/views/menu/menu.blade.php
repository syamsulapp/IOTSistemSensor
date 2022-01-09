<!-- Side menu START -->
<div id="sidebar" class="sidebar-offcanvas">
    <ul class="nav flex-column nav-sidebar">
        <li class="nav-item active">
            <a class="nav-link active" href="{{ route('home') }}">
                <svg class="icon-sprite">
                    <use xlink:href="{{ asset('assets/images/icons-sprite.svg#home') }}" />
                </svg> Home
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('suhu') }}">
                <svg class="icon-sprite">
                    <use xlink:href="{{ asset('assets/images/icons-sprite.svg#thermometer') }}" />
                </svg> <span>Suhu</span>
            </a>
        </li>
    </ul>
</div>