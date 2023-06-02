@extends('Admin.admin_layout')
@section('content')
    <div class="page-wrapper">
        <div class="content">
            <div class="row mb-3">
                @if(Session::has("message"))
                    <span class="bg-info p-2 text-white mb-3">{{ Session::get("message") }}</span>
                @endif
            </div>
            
            <div class="row mt-2">
                

                <div class="col-sm-4 col-3">
                    <h4 class="page-title">All Scans</h4>
                </div>
                {{-- <div class="col-sm-8 col-9 text-right m-b-20">
                    <a href="{{ url('admin/create-user') }}" class="btn btn btn-primary btn-rounded float-right"><i
                            class="fa fa-plus"></i> Add Scan</a>
                </div> --}}
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-border table-striped custom-table datatable mb-0">
                            <thead>
                                <tr>
                                    <th style="width: 3%;">ID</th>
                                    <th style="width: 10%;">User Name</th>
                                    <th style="width: 10%;">Email</th>
                                    <th style="width: 10%;">Website URL</th>
                                    <th style="width: 10%;">Type</th>
                                    <th style="width: 5%;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!empty($scans))
                                    @foreach ($scans as $key => $scan )
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $scan->user_name }}</td>
                                            <td>{{ $scan->user_email }}</td>
                                            <td>{{ $scan->website_url }}</td>
                                            <td><span class="text-uppercase">{{ $scan->type }}</span></td>
                                            <td class="">
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                        aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="{{ url('admin/delete-scan/'.$scan->id) }}" onclick="return confirm('Do you want to Delete This Scan?')"><i class="fa fa-trash-o m-r-5"></i>
                                                            Delete</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
