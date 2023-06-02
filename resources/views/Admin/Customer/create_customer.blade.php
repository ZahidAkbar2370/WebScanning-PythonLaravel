@extends('Admin.admin_layout')
@section('content')
    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="page-title">Create Customer</h4>
                </div>
            </div>
            <form action="{{ URL::to('admin/save-customer') }}" method="post">
                @csrf
                <div class="row">

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Shop Name <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="name" value="{{ old('name') }}" placeholder="Enter Shop Name" required>
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
                </div>
                <div class="m-t-20 text-center">
                    <button class="btn btn-primary submit-btn" onclick="return confirm('Are you Sure to Add Customer')">Save Customer</button>
                </div>
        </div>
        </form>
    </div>
@endsection
