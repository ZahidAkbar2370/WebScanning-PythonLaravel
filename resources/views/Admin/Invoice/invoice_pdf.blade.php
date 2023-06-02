<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Green Star {{ $invoice_detail->invoice_no }} Invoice</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap-datetimepicker.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
		<script src="{{ asset('assets/js/html5shiv.min.js') }}"></script>
		<script src="{{ asset('assets/js/respond.min.js') }}"></script>
</head>

<body>
    
<div class="page-wrapper" style="margin: 10px !important;">
    <div class="content">
        <div class="row">
            <div class="col-sm-5 col-4">
                <h4 class="page-title">Invoice</h4>
            </div>
            <div class="col-sm-7 col-8 text-right m-b-30">
                <div class="btn-group btn-group-sm">
                    <button class="btn btn-white" onclick="window.print()"><i class="fa fa-print fa-lg"></i> Print</button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row custom-invoice">
                            <div class="col-6 col-sm-6 m-b-20">
                                <img src="{{ asset('logo.jpeg') }}" class="inv-logo" alt="">
                                <ul class="list-unstyled">
                                    <li><h4>Green Star Packages</h4></li>
                                    <li>Lab E Neelum Pull,</li>
                                    <li>GC University Road Layyah</li>
                                    <li>Contact #: 03126302579</li>
                                </ul>
                            </div>
                            <div class="col-6 col-sm-6 m-b-20">
                                <div class="invoice-details">
                                    <h4 class="text-uppercase">Invoice # {{ $invoice_detail->invoice_no }}</h4>
                                    <ul class="list-unstyled">
                                        <li>Order Date: <span>{{ $invoice_detail->created_at }}</span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 col-lg-6 m-b-20">
                                
                                    <h5>Invoice to:</h5>
                                    <ul class="list-unstyled">
                                        <li>
                                            <h5><strong>Shop: {{ $invoice_detail->customer_name ?? "" }}</strong></h5>
                                        </li>
                                        <li><span>Sale Man: {{ $invoice_detail->sale_man_name ?? "" }}</span></li>
                                     </ul>
                                
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>ITEM</th>
                                        <th>SIZE</th>
                                        <th>UNIT COST</th>
                                        <th>QUANTITY</th>
                                        <th>TOTAL</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($invoiceBySales))
                                        @foreach ($invoiceBySales as $key => $invoiceBySale)
                                            <tr>
                                                <td>{{ $key+1 }}</td>
                                                <td>{{ $invoiceBySale->product_title ?? "" }}</td>
                                                <td>{{ $invoiceBySale->product_width ?? "" }} X {{ $invoiceBySale->product_height ?? "" }}</td>
                                                <td>RS: {{ $invoiceBySale->sale_price ?? "" }}</td>
                                                <td>{{ $invoiceBySale->quantity ?? "" }}</td>
                                                <td>RS: {{ $invoiceBySale->grand_total ?? "" }}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div>
                            <div class="row invoice-payment">
                                <div class="col-sm-7">
                                </div>
                                <div class="col-sm-5">
                                    <div class="m-b-20">
                                        <h6>Total due</h6>
                                        <div class="table-responsive no-border">
                                            <table class="table mb-0">
                                                <tbody>
                                                    <tr>
                                                        <th>Items:</th>
                                                        <td class="text-right">{{ $invoice_detail->total_items }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Total:</th>
                                                        <td class="text-right text-primary">
                                                            <h5>RS:{{ $invoice_detail->grand_price }}</h5>
                                                        </td>
                                                    </tr>
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


    <div class="sidebar-overlay" data-reff=""></div>
    <script src="{{ asset('assets/js/jquery-3.2.1.min.js') }}"></script>
	<script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
	<script src="{{ asset('assets/js/moment.min.js') }}"></script>
	<script src="{{ asset('assets/js/bootstrap-datetimepicker.min.js') }}"></script>
	
</body>

</html>
