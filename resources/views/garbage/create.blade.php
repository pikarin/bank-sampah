@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <form action="{{ route('garbage.store') }}" method="POST">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">{{ __('Add new garbage') }}</h6>

                            @include('garbage._form')
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
