@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Website Vulnerability</div>

                <div class="card-body">
                    <form method="POST" action="{{ URL::to('url-scan') }}">
                        @csrf

                        <div class="row mb-3">

                            <div class="col-md-6">
                                <input type="hidden" name="type" value="{{ $targetUrl ?? '' }}">
                                <input id="email" type="url" class="form-control @error('email') is-invalid @enderror" @if(isset($url)) value="{{ $url }}" @endif name="url" required>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                            
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary">
                                    Scan
                                </button>
                            </div>
                        </div>


                    </form>
                </div>
            </div>
        </div>



        @if(isset($urlScanning))
            <div class="row mt-6">
                <div class="col-md-12">
                    <p>{{ print_r($urlScanning) }}</p>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
