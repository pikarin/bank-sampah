@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">{{ $garbage->name }}</h6>

                        <dl class="row">
                            <dt class="col-sm-3">{{ __('Buy Price') }}</dt>
                            <dd class="col-sm-9">{{ $garbage->buy_price }}</dd>

                            <dt class="col-sm-3">{{ __('Sell Price') }}</dt>
                            <dd class="col-sm-9">{{ $garbage->sell_price }}</dd>

                            <dt class="col-sm-3">{{ __('Description') }}</dt>
                            <dd class="col-sm-9">{{ $garbage->description }}</dd>
                        </dl>

                        <a href="{{ route('garbage.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left"></i>
                            {{ __('Back') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
