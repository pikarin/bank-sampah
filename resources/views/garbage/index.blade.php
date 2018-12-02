@extends('layouts.master')

@inject('str', 'Illuminate\Support\Str')

@section('content')
<div class="container-fluid">
    @include('partials._alert-success')

    <a href="{{ route('garbage.create') }}" class="btn btn-primary btn-lg mb-3">
        {{ __('Add new garbage') }}
    </a>

    <div class="card">
        <div class="card-body table-responsive p-0">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Buy price') }}</th>
                        <th>{{ __('Sell price') }}</th>
                        <th>{{ __('Description') }}</th>
                        <th>{{ __('Action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($garbage as $key => $trash)
                        <tr>
                            <td>{{ $key + $garbage->firstItem() }}</td>
                            <td>{{ $trash->name }}</td>
                            <td>{{ $trash->buy_price }}</td>
                            <td>{{ $trash->sell_price }}</td>
                            <td>{{ $str->words($trash->description, 10) }}</td>
                            <td>
                                <a href="{{ route('garbage.show', $trash) }}" class="btn btn-sm btn-secondary mb-1">
                                    <i class="fas fa-eye mr-1"></i>
                                    {{ __('View') }}
                                </a>
                                <a href="{{ route('garbage.edit', $trash) }}" class="btn btn-sm btn-warning mb-1">
                                    <i class="fas fa-edit mr-1"></i>
                                    {{ __('Edit') }}
                                </a>
                                <form class="d-inline-block" action="{{ route('garbage.destroy', $trash) }}" method="POST"
                                    onsubmit="return confirm('Do you really want to delete that?');"
                                >
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-sm btn-danger mb-1">
                                        <i class="fas fa-trash mr-1"></i>
                                        {{ __('Delete') }}
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="card-footer cleafix">
            {{ $garbage->links() }}
        </div>
    </div>
</div>
@endsection
