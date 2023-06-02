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
                    <h4 class="page-title"> View Users</h4>
                </div>
                <div class="col-sm-8 col-9 text-right m-b-20">
                    <a href="{{ url('admin/create-user') }}" class="btn btn btn-primary btn-rounded float-right"><i
                            class="fa fa-plus"></i> Add User</a>
                </div>
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
                                    <th style="width: 10%;">Total Scans</th>
                                    <th style="width: 10%;">Status</th>
                                    <th style="width: 5%;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!empty($users))
                                    @foreach ($users as $key => $user )
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ count($user->scans) ?? 0 }}</td>
                                            <td><span class="text-uppercase">{{ $user->status }}</span></td>
                                            <td class="">
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                        aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="{{ url('admin/delete-user/'.$user->id) }}" onclick="return confirm('Do you want to Delete This User?')"><i class="fa fa-trash-o m-r-5"></i>
                                                            Delete</a>

                                                            @if($user->status == "active")
                                                                <a class="dropdown-item" href="{{ url('admin/inactive-user/'.$user->id) }}" onclick="return confirm('Do you want to Inactive This User?')"><i class="fa fa-thumbs-down m-r-5"></i>
                                                                    Inactive</a>
                                                            @else
                                                                <a class="dropdown-item" href="{{ url('admin/active-user/'.$user->id) }}" onclick="return confirm('Do you want to Activate This User?')"><i class="fa fa-thumbs-up m-r-5"></i>
                                                                    Active</a>
                                                            @endif
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
