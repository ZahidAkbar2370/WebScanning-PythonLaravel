@extends('Admin.admin_layout')
@section('content')
    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                @if(Session::has("message"))
                    <span class="bg-info p-2 text-white mb-3">{{ Session::get("message") }}</span>
                @endif

                <div class="col-lg-12">
                    <h4 class="page-title">Change Password</h4>
                </div>
            </div>
            <form action="{{ URL::to('admin/change-password') }}" method="post">
                @csrf
                <div class="row">

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Old Password <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="old_password" value="{{ old('old_password') }}" placeholder="Enter Old Password" required>
                        </div>

                        @error('old_password')
                            <span class="text-danger">{{ $errors->first('old_password') }}</span>
                        @enderror
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>New Password <span class="text-danger">*</span></label>
                            <input class="form-control" type="number" name="new_password" value="{{ old('new_password') }}" placeholder="Enter Number" required>

                            @error('new_password')
                                <span class="text-danger">{{ $errors->first('new_password') }}</span>
                            @enderror
                        </div>
                    </div>

                </div>
                <div class="m-t-20 text-center">
                    <button class="btn btn-primary submit-btn" onclick="return confirm('Are you Sure to Change Password')">Change Password</button>
                </div>
        </div>
        </form>
    </div>
@endsection
