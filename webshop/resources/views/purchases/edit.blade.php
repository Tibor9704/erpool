@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Vásárlás módosítása</h2>

        <form method="post" action="{{ route('purchases.update', $purchase->id) }}">
            @csrf
            @method('put')

            <label for="product_id">Termék kiválasztása:</label>
            <select name="product_id" required>
                @foreach($products as $product)
                    <option value="{{ $product->id }}" {{ $purchase->product_id == $product->id ? 'selected' : '' }}>
                        {{ $product->name }}
                    </option>
                @endforeach
            </select>

            <label for="quantity">Mennyiség:</label>
            <input type="number" name="quantity" value="{{ $purchase->quantity }}" required>

            <p>Összeg: {{ number_format($totalPrice, 2) }} {{ optional($purchase->product)->currency }}</p>

            <button type="submit">Mentés</button>
        </form>
    </div>
@endsection
