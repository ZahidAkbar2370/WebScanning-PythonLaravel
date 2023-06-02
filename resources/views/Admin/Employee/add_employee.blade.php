@extends('Admin.admin_layout')
@section('content')
    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="page-title">Create Employee</h4>
                </div>
            </div>
            <form action="{{ URL::to('admin/save-employee') }}" method="post">
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
                            <label>Mobile # <span class="text-danger">*</span></label>
                            <input class="form-control" type="number" name="mobile_no" value="{{ old('mobile_no') }}" placeholder="Enter Number" required>

                            @error('mobile_no')
                                <span class="text-danger">{{ $errors->first('mobile_no') }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>City <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="city" value="{{ old('city') }}" placeholder="Enter City" required>

                            @error('city')
                                <span class="text-danger">{{ $errors->first('city') }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label>Role<span class="text-danger">*</span></label>
                            <select class="form-control select" required name="role" value="{{ old('role') }}">
                                <option value="">Choice</option>
                                <option value="employee">Employee</option>
                                <option value="sale_man">Sale Man</option>
                            </select>

                            @error('role')
                                <span class="text-danger">{{ $errors->first('role') }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="m-t-20 text-center">
                    <button class="btn btn-primary submit-btn" onclick="return confirm('Are you Sure to Add Employee')">Save Employee</button>
                </div>
        </div>
        </form>
    </div>
@endsection
