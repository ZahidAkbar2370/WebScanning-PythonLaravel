@extends('Admin.admin_layout')
@section('content')

<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
                <div class="dash-widget">
                   
                    <div class="dash-widget-info text-center">
                        <h3>{{ $totalUsers ?? 0 }}</h3>
                        <span class="widget-title1">Users</span>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
                <div class="dash-widget">
                   
                    <div class="dash-widget-info text-center">
                        <h3>{{ $activeUsers ?? 0 }}</h3>
                        <span class="widget-title1">Active Users</span>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
                <div class="dash-widget">
                   
                    <div class="dash-widget-info text-center">
                        <h3>{{ $inactiveUsers ?? 0 }}</h3>
                        <span class="widget-title1">Inactive Users</span>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
                <div class="dash-widget">
                   
                    <div class="dash-widget-info text-center">
                        <h3>{{ $totalScans ?? 0 }}</h3>
                        <span class="widget-title1">Total Scans</span>
                    </div>
                </div>
            </div>

            
</div>


@endsection