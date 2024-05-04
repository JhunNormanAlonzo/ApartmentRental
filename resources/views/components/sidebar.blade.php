<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link " href="{{route('home')}}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

{{--        <li class="nav-item">--}}
{{--            <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">--}}
{{--                <i class="bi bi-menu-button-wide"></i><span>Rooms</span><i class="bi bi-chevron-down ms-auto"></i>--}}
{{--            </a>--}}
{{--            <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">--}}
{{--                <li>--}}
{{--                    <a href="components-alerts.html">--}}
{{--                        <i class="bi bi-circle"></i><span>Add Room</span>--}}
{{--                    </a>--}}
{{--                </li>--}}

{{--            </ul>--}}
{{--        </li><!-- End Components Nav -->--}}



        <li class="nav-heading">Pages</li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{route('inclusions.index')}}">
                <i class="bi bi-table"></i>
                <span>Inclusions</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{route('rooms.index')}}">
                <i class="bi bi-door-open-fill"></i>
                <span>Rooms</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{route('tenants.index')}}">
                <i class="bi bi-people-fill"></i>
                <span>Tenants</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{route('ledgers.index')}}">
                <i class="bi bi-people-fill"></i>
                <span>Payment</span>
            </a>
        </li>







    </ul>

</aside>
<!-- End Sidebar-->
