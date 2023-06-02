@extends('Admin.admin_layout')
@section('content')
    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="page-title">Edit Product</h4>
                </div>
            </div>
            <form action="{{ URL::to('admin/update-product') }}" method="post" enctype="multipart/form-data">
                @csrf
            <div class="row">
                    <div class="col-sm-6 col-md-6 col-lg-6">
                        <div class="form-group">
                                    <input type="hidden" value="{{ $editProduct->id }}" name="id">
                                    <label>Product Title<span class="text-danger">*</span></label>
                                    <select class="form-control select" name="product_title_id" required>
                                        <option value="">Choice Title</option>
                                        @if(!empty($productTitles))
                                            @foreach ($productTitles as $productTitle)
                                                <option value="{{ $productTitle->product_title }}" @if($productTitle->product_title == $editProduct->product_title) selected @endif>{{ $productTitle->product_title }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label>Width<span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" value="{{ $editProduct->product_width }}" name="product_width" placeholder="Width" required>
                                </div>
                            </div>
                            <div class="col-sm-3 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label>Height<span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" value="{{ $editProduct->product_height }}" name="product_height" placeholder="Height" required>
                                </div>
                            </div>
                        </div>
                        <div class="m-t-20 ">
                            <button type="submit" class="btn btn-primary submit-btn">Add Product</button>
                        </div>
                    </div>
                </form>
    </div>

@endsection
