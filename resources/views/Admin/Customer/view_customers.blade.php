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
                    <h4 class="page-title"> View Customers</h4>
                </div>
                <div class="col-sm-8 col-9 text-right m-b-20">
                    <a href="{{ url('admin/create-customer') }}" class="btn btn btn-primary btn-rounded float-right"><i
                            class="fa fa-plus"></i> Add Customer</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-border table-striped custom-table datatable mb-0">
                            <thead>
                                <tr>
                                    <th style="width: 3%;">ID</th>
                                    <th style="width: 10%;">Shop Name</th>
                                    <th style="width: 10%;">Mobile #</th>
                                    <th style="width: 10%;">City</th>
                                    <th style="width: 10%;">Balance</th>
                                    <th style="width: 5%;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!empty($customers))
                                    @foreach ($customers as $key => $customer )
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td><a href="{{ url('admin/view-balances?customer_name='.$customer->name) }}">{{ $customer->name }}</a></td>
                                            {{-- <td>{{ $customer->name}}</td> --}}
                                            <td>{{ $customer->mobile_no }}</td>
                                            <td>{{ $customer->city }}</td>
                                            <?php 

                                            $balance = 0;
                                            $checkBalance = \App\Models\Balance::where("customer_name", $customer->name)->orderBy("id", "DESC")->first();

                                            if(isset($checkBalance)){
                                                $balance = $checkBalance->balance;
                                            }
                                            ?>
                                            <td class="@if($balance > 0) bg-danger @else bg-success @endif text-center" style="font-size: 21px">{{ $balance}}</td>

                                            <td class="">
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                        aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="{{ url('admin/delete-customer/'.$customer->id) }}" onclick="return confirm('Do you want to Delete This Customer?')"><i class="fa fa-trash-o m-r-5"></i>
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
