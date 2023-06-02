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
                    <h4 class="page-title"> View Payments</h4>
                </div>
                <div class="col-sm-8 col-9 text-right m-b-20">
                    <a href="{{ url('admin/view-balances') }}" class="btn btn btn-primary btn-rounded mr-2"><i
                            class="fa fa-refresh"></i> Reload</a>

                    <a href="{{ url('admin/create-balance') }}" class="btn btn btn-primary btn-rounded float-right"><i
                                class="fa fa-plus"></i> Add Payment</a>
                </div>
            </div>
            <div class="row">

                <div class="col-md-3 text-center">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Total Sale</h3>
                        </div>
                        <div class="card-body">
                            {{ $totalDebits }}
                        </div>
                    </div>
                </div>

                <div class="col-md-3 text-center">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Total Recover</h3>
                        </div>
                        <div class="card-body">
                            {{ $totalCredits }}
                        </div>
                    </div>
                </div>

                <div class="col-md-3 text-center">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Balance</h3>
                        </div>
                        <div class="card-body">
                            {{ $totalDebits - $totalCredits }}
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="row">
                    <div class="col-6">
                            <form method="get">
                            <div class="row">
                        <div class="col-md-8 mb-3">
                            <label>Search By Sale Man</label>
                            <input class="form-control" name="sale_man" type="text">
                        </div>

                        <div class="col-md-4">
                            <input class="btn btn-primary mt-4" type="submit" value="Search">
                        </div>
                        </div>
                    </form>
                        </div>

                    
                    <div class="col-6">
                            <form method="get">
                            <div class="row">
                        <div class="col-md-8">
                            <label>Search By Customer</label>
                            <input class="form-control" name="customer_name" value="" type="text">
                        </div>

                        <div class="col-md-4">
                            <input class="btn btn-primary mt-4" type="submit" value="Search">
                        </div>
                    </div>
                </form>
                </div>
        
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-border table-striped custom-table datatable mb-0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Customer Name</th>
                                    <th>Sale Man</th>
                                    <th>Grand Total</th>
                                    <th>Paid</th>
                                    <th>Balance</th>
                                    <th>Payment Date</th>
                                    <th>Invoice No</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                @if(!empty($balances))
                                    @foreach ($balances as $key => $balance )
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $balance->customer_name }}</td>
                                            <td>{{ $balance->sale_man_name }}</td>
                                            <td>{{ $balance->debits }}</td>
                                            <td>{{ $balance->credits }}</td>
                                            <td>{{ $balance->balance }}</td>
                                            <td>{{ $balance->payment_date }}</td>
                                            <td><a href="{{ url('generate-invoice-pdf/'.$balance->invoice_no) }}" target="_blank">{{ $balance->invoice_no }}</a></td>
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
