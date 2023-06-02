@extends('Admin.admin_layout')
@section('content')


<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-sm-5 col-4">
                <h4 class="page-title">Invoice</h4>
            </div>
            <div class="col-sm-7 col-8 text-right m-b-30">
                <div class="btn-group btn-group-sm">
                    <a target="_blank" href="{{ url('generate-invoice-pdf/'.$invoice_detail->invoice_no) }}" class="btn btn-white"><i class="fa fa-print fa-lg"></i> Print</a>
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
                                    <h3 class="text-uppercase">Invoice # {{ $invoice_detail->invoice_no }}</h3>
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
                                        <li><span>Shop: {{ $invoice_detail->customer_name ?? "" }}</span></li>
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
                                                <td>{{ $invoiceBySale->product_width . " X " . $invoiceBySale->product_height ?? "" }}</td>
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
                                                        <td class="text-right"># {{ $invoice_detail->total_items }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Total:</th>
                                                        <td class="text-right">
                                                            <h5>RS:{{ $invoice_detail->grand_price }}</h5>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <th>Advance Paid:</th>
                                                        <td class="text-right">
                                                            <h5>RS:{{ $checkAdvancePayment->credits }}</h5>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <th>Balance:</th>
                                                        <td class="text-right text-primary">
                                                            <h5>RS:{{ $checkAdvancePayment->balance }}</h5>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Paid</th>
                                            <th>Remaining</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(isset($checkBalances) && $checkBalances < $invoice_detail->grand_price)

                                        <button class="btn btn-primary mb-2" data-toggle="modal" data-target="#exampleModal">Add Balance</button>
                                        @endif
                                        @if (!empty($totalPaidBalance))
                                            @foreach ($totalPaidBalance as $key => $totalPaid)
                                                <tr>
                                                    <td>{{ $key+1 }}</td>
                                                    <td>{{ $totalPaid->paid_amount ?? "" }}</td>
                                                    <td>{{ $totalPaid->balance ?? "" }}</td>
                                                    <td>{{ $totalPaid->payment_date ?? "" }}</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection