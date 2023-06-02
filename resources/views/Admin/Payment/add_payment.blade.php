@extends('Admin.admin_layout')
@section('content')
    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="page-title">New Payment</h4>
                </div>
            </div>
            <form action="{{ URL::to('admin/save-balance') }}" method="post" enctype="multipart/form-data">
                @csrf
            <div class="row">
                            <div class="col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Sale Man<span class="text-danger">*</span></label>
                                    <select class="form-control select" name="sale_man_name" required>
                                        <option value="">Choice Sale Man</option>
                                        @if(!empty($saleMans))
                                            @foreach ($saleMans as $saleMan)
                                                <option value="{{ $saleMan->name }}">{{ $saleMan->name }} - {{ $saleMan->city }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Customer Name<span class="text-danger">*</span></label>
                                    <select class="form-control select" name="customer_name" required>
                                        <option value="">Choice Customer</option>
                                        @if(!empty($customers))
                                            @foreach ($customers as $customer)
                                                <option value="{{ $customer->name }}">{{ $customer->name }} - {{ $customer->city }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-3 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label>Payment Date<span class="text-danger">*</span></label>
                                    <input class="form-control" type="date" name="payment_date" required>
                                </div>
                            </div>
                            <div class="col-sm-3 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label>Amount<span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="amount" placeholder="Enter Recived Amount" required>
                                </div>
                            </div>
                        </div>
                        <div class="m-t-20 ">
                            <button type="submit" class="btn btn-primary submit-btn">Add Payment</button>
                        </div>
                    </div>
                </form>
    </div>

@endsection
