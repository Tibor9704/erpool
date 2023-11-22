@extends('layouts.app')

@section('content')
    <h1>Termék módosítása</h1>

    <form method="post" action="{{ route('products.update', $product->id) }}">
        @csrf
        @method('put')

        <label for="name">Név:</label>
        <input type="text" name="name" value="{{ $product->name }}" required>

        <label for="unit_price">Egységár:</label>
        <input type="number" name="unit_price" value="{{ $product->unit_price }}" required>

        <button type="submit">Mentés</button>
    </form>
@endsection
