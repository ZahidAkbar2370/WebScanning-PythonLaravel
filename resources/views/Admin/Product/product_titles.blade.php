@extends('Admin.admin_layout')
@section('content')
    <div class="page-wrapper">
        <div class="content">
            
            <div class="row">
                @if(Session::has("message"))
                    <span class="bg-info p-2 text-white mb-3">{{ Session::get("message") }}</span>
                @endif
                <div class="col-lg-12">
                    <h4 class="page-title">New Product Title</h4>
                </div>
            </div>
            <div class="row">
                
                <div class="col-lg-12">
                    <form action="{{ URL::to('admin/save-product-title') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    @if(!empty($editProductTitle))
                                        <input class="form-control" name="id" @if(!empty($editProductTitle)) value="{{ $editProductTitle->id }}" @endif type="hidden">
                                    @endif
                                    <label>Product Title <span class="text-danger">*</span></label>
                                    <input class="form-control" name="product_title" @if(!empty($editProductTitle)) value="{{ $editProductTitle->product_title }}" @endif type="text">

                                    @error('product_title')
                                        <span class="text-danger">{{ $errors->first('product_title') }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <div class="m-t-20 text-center">
                            <button class="btn btn-primary submit-btn">Add Product Title</button>
                        </div>
                    </form>
                </div>
            </div>


            <div class="row mt-5">
                <div class="col-lg-12">
                    <h4 class="page-title">Product Title List</h4>
                </div>
            </div>


            <div class="row mt-3">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-border table-striped custom-table datatable mb-0">
                            <thead>
                                <tr>
                                    <th style="width: 10%;">SR #</th>
                                    <th style="width: 60%;">Product Name</th>
                                    <th style="width: 15%;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($productTitles)
                                    @foreach ($productTitles as $key => $productTitle)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $productTitle->product_title }}</td>
                                            <td class="">
                                                <a href="{{ url('admin/product-title?id='.$productTitle->id) }}" class="btn btn-info text-white"><i class="fa fa-edit"></i></a>
                                                <a class="btn btn-danger text-white" href="{{ url('admin/delete-product-title/'.$productTitle->id) }}"
                                                    onclick="return confirm('are you sure to delete it?')"><i
                                                        class="fa fa-trash"></i></a>
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

    </div>
@endsection
