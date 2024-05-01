@extends('layouts.master')

@section('content')
    @php
        $rooms = 40;
        $tenants = 12;
        $occupied = 12;
    @endphp

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Dashboard</h1>
        </div><!-- End Page Title -->


        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-12">
                    <div class="row">

                        <!-- Sales Card -->
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card sales-card">
                                <div class="card-body">
                                    <h5 class="card-title">Room <span>| Total</span></h5>
                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-door-closed"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{$rooms}}</h6>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><!-- End Sales Card -->

                        <!-- Revenue Card -->
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card revenue-card">

                                <div class="card-body">
                                    <h5 class="card-title">Tenants <span>| Total</span></h5>

                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-people-fill"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{$tenants}}</h6>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><!-- End Revenue Card -->

                        <!-- Customers Card -->
                        <div class="col-xxl-4 col-xl-12">

                            <div class="card info-card customers-card">
                                <div class="card-body">
                                    <h5 class="card-title">Occupied <span>| Rooms </span></h5>

                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-hospital"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{$occupied}} over {{$rooms}} rooms</h6>
                                            <span class="text-danger small pt-1 fw-bold">{{$rooms - $occupied}}</span> <span class="text-muted small pt-2 ps-1">Available</span>

                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div><!-- End Customers Card -->

                        <div class="col-12">
                            <div class="card">
                                <div class="filter">
                                    <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                        <li class="dropdown-header text-start">
                                            <h6>Filter</h6>
                                        </li>

                                        <li><a class="dropdown-item" href="#">Today</a></li>
                                        <li><a class="dropdown-item" href="#">This Month</a></li>
                                        <li><a class="dropdown-item" href="#">This Year</a></li>
                                    </ul>
                                </div>

                                <div class="card-body">
                                    <h5 class="card-title">Recent Activity</h5>

                                    <div class="activity">
                                        @php
                                            $color = array("text-success", "text-danger", "text-info", "text-warning", "text-primary");
                                        @endphp
                                        @for($x=1; $x<=5; $x++)
                                            <div class="activity-item d-flex">
                                                <div class="activite-label">Room {{$x}}</div>
                                                <i class='bi bi-circle-fill activity-badge {{$color[$x-1]}} align-self-start'></i>
                                                <div class="activity-content">
                                                     <a href="#" class="fw-bold text-dark">Paid Bill</a>  for the month of January
                                                </div>
                                            </div>
                                        @endfor




                                    </div>

                                </div>
                            </div><!-- End Recent Activity -->
                        </div>

                        <!-- Top Selling -->
                        <div class="col-12">
                            <div class="card top-selling overflow-auto">


                                <div class="card-body pb-0">
                                    <h5 class="card-title">Top Payer  <span>| Current Month</span></h5>

                                    <table class="table table-borderless">
                                        <thead>
                                        <tr>
                                            <th scope="col">Unit</th>
                                            <th scope="col">Amount</th>
                                            <th scope="col">Date</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @for($x=1; $x<=5; $x++)

                                        <tr>
                                            <td><a href="#" class="text-primary fw-bold">Room {{random_int(1, 40)}}</a></td>
                                            <td class="fw-bold">{{number_format(random_int(2500, 5000))}}</td>
                                            <td>{{now()}}</td>
                                        </tr>
                                        @endfor
                                        </tbody>
                                    </table>

                                </div>

                            </div>
                        </div><!-- End Top Selling -->

                    </div>
                </div><!-- End Left side columns -->


            </div>
        </section>

    </main><!-- End #main -->
@endsection
