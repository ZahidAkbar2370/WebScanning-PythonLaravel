@extends('Admin.admin_layout')
@section('content')
    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="page-title">Create User</h4>
                </div>
            </div>
            <form action="{{ URL::to('admin/save-user') }}" method="post">
                @csrf
                <div class="row">

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Name <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="name" value="{{ old('name') }}" placeholder="Enter Name" required>
                        </div>

                        @error('name')
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        @enderror
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Email <span class="text-danger">*</span></label>
                            <input class="form-control" type="email" name="email" value="{{ old('email') }}" placeholder="Enter Number" required>

                            @error('email')
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Password <span class="text-danger">*</span></label>
                            <input class="form-control" type="password" name="password" value="{{ old('password') }}" placeholder="Enter Password" required>

                            @error('password')
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="m-t-20 text-center">
                    <button class="btn btn-primary submit-btn" onclick="return confirm('Are you Sure to Add User')">Save Employee</button>
                </div>
        </div>
        </form>
    </div>
@endsection
