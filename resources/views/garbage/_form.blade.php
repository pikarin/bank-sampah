@include('partials._alert-errors')
@csrf
<div class="form-group">
    <label for="name">{{ __('Name') }}</label>
    <input type="text" class="form-control" id="name" name="name"
        value="{{ old('name', $garbage->name) }}"
    >
</div>

<div class="form-group">
    <label for="buy_price">{{ __('Buying Price') }}</label>
    <input type="text" class="form-control" id="buy_price" name="buy_price"
        value="{{ old('buy_price', $garbage->buy_price) }}"
    >
</div>

<div class="form-group">
    <label for="sell_price">{{ __('Selling Price') }}</label>
    <input type="text" class="form-control" id="sell_price" name="sell_price"
        value="{{ old('sell_price', $garbage->sell_price) }}"
    >
</div>

<div class="form-group">
    <label for="description">{{ __('Description') }}</label>
    <textarea class="form-control" name="description" id="description" rows="5"
    >{{ old('description', $garbage->description) }}</textarea>
</div>

<a href="{{ route('garbage.index') }}" class="btn btn-outline-secondary">
    <i class="fas fa-arrow-left"></i>
    {{ __('Back') }}
</a>
<button class="btn btn-primary">
    <i class="fas fa-save"></i>
    {{ __('Save') }}
</button>
