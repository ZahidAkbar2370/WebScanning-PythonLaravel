@extends('Admin.admin_layout')
@section('content')

<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-sm-12">
                <h4 class="page-title">Create Invoice</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                @if (Session::has("success"))
                    <p class="bg-success p-2 text-white">{{ Session::get("success") }}</p>                    
                @endif
                <form action="{{ URL::to('admin/add-to-invoice') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6 col-md-3">
                            <div class="form-group">
                                <label>Product<span class="text-danger">*</span></label>
                                <select class="select" required name="product_id" onchange="smschange(this.value)">
                                    <option value="">Please Select</option>
                                    @if (!empty($products))
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->product_title }} - {{ $product->product_width }} X {{ $product->product_height }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="form-group">
                                <label>Quantity</label>
                                <input class="form-control" name="quantity" value="1" oninput="calculateTotal()" id="quantity" type="number">
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-3">
                            <div class="form-group">
                                <label>Sale Price</label>
                                <input class="form-control" name="sale_price" id="sale_price"  oninput="calculateTotal()" type="number" value="0" min="0">
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-3">
                            <div class="form-group">
                                <label>Grand Total</label>
                                <input class="form-control" name="grand_total" value="0" id="grand_total" type="number" readonly>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-3">
                            <div class="form-group">
                                <label></label>
                                <button type="submit" class="btn btn-primary submit-btn mt-4">Add To Invoice</button>
                            </div>
                        </div>
                    </div>
                </form>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="table-responsive">
                                <table class="table table-hover table-white">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Item</th>
                                            <th>Size</th>
                                            <th>Unit Cost</th>
                                            <th>Qty</th>
                                            <th>Amount</th>
                                            <th> </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $subtotal = 0; $items = 0; $totalDiscount = 0; @endphp
                                        @if(session('cart'))
                                        @foreach(session('cart') as $id => $details)
                                            @php $subtotal += $details['sale_price'] * $details['quantity']; $items ++;@endphp
                                        <tr>
                                            <td>{{ $id }}</td>
                                            <td>{{ $details["product_name"] ?? "" }}</td>
                                            <td>
                                                {{ $details["size"] ?? "" }}
                                            </td>
                                            <td>
                                                {{ $details["sale_price"] ?? "" }}
                                            </td>
                                            <td>
                                                {{ $details["quantity"] ?? "" }}
                                            </td>
                                            <td>
                                                {{ $details['sale_price'] * $details['quantity'] }}
                                            </td>
                                            <td><a href="{{ url('admin/remove-from-invoice/'.$id) }}" class="text-success font-18" title="Add"><i class="fa fa-trash-o"></i></a></td>
                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover table-white">
                                    <tbody>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td class="text-right">Total</td>
                                            <td style="text-align: right; padding-right: 30px;width: 230px">{{ $subtotal }}</td>
                                        </tr>

                                        <tr>
                                            <td colspan="5" class="text-right">Items</td>
                                            <td style="text-align: right; padding-right: 30px;width: 230px">{{ $items }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="5" style="text-align: right; font-weight: bold">
                                                Grand Total
                                            </td>
                                            <td style="text-align: right; padding-right: 30px; font-weight: bold; font-size: 16px;width: 230px">
                                                Rs: {{ $subtotal - $totalDiscount }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="m-t-20">
                        <form action="{{ URL::to('admin/save-invoice') }}" method="post">
                            @csrf

                            <div class="row">
                                <div class="col-sm-6 col-md-3">
                                    <div class="form-group">
                                        <label>Customer<span class="text-danger">*</span></label>
                                        <select class="select" required name="customer_name">
                                            <option value="">Please Select</option>
                                            @if (!empty($customers))
                                                @foreach ($customers as $customer)
                                                    <option value="{{ $customer->name }}">{{ $customer->name }} - {{ $customer->city }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-md-3">
                                    <div class="form-group">
                                        <label>Sale Man<span class="text-danger">*</span></label>
                                        <select class="select" required name="sale_man_name">
                                            <option value="">Please Select</option>
                                            @if (!empty($dealers))
                                                @foreach ($dealers as $dealer)
                                                    <option value="{{ $dealer->name }}">{{ $dealer->name }} - {{ $dealer->city }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-md-3">
                                    <div class="form-group">
                                        <label>Paid Amount<span class="text-danger">*</span></label>
                                        <input class="form-control" name="paid_amount" value="0" type="number">
                                    </div>
                                </div>

                                <div class="col-sm-6 col-md-3">
                                    <div class="form-group">
                                        <button  class="btn btn-primary submit-btn mt-4" type="submit">Save & Send</button>
                                    </div>
                                </div>
                            </div>
                            
                        </form>
                    </div>
                
            </div>
        </div>
    </div>
</div>


<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    
<script>

    function smschange(id){
        let baseurl = "get-product/"+id;
        $.ajax({
                url: baseurl,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    document.getElementById("sale_price").value = data.product_sale_price;

                    calculateTotal();
                }
            });
    }

    function calculateTotal(){
            var purchasePrice = document.getElementById("sale_price").value;
            var purchaseQuantity = document.getElementById("quantity").value;
            // var discount = document.getElementById("discount").value;


            if(purchasePrice != '' && purchaseQuantity != ''){
                var total = purchasePrice * purchaseQuantity;

                document.getElementById("grand_total").value = total;
            
            }


        }
   
</script>
      

@endsection