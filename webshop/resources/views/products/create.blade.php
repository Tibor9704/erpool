@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Új Termék</h1>

        <form method="post" action="{{ route('products.store') }}">
            @csrf

            <div>
                <label for="name">Név:</label>
                <input type="text" name="name" required>
            </div>

            <div>
                <label for="unit_price">Egységár:</label>
                <input type="number" name="unit_price" required>
            </div>


            <button type="submit">Mentés</button>
        </form>
    </div>
@endsection
