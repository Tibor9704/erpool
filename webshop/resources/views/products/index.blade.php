@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Termékek</h2>
        <a class="nav-link" href="{{ route('products.create') }}">Új termék</a>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Név</th>
                    <th scope="col">Egységár</th>
                    <th scope="col">3 darabos ár</th>
                    <th scope="col">5 darabos ár</th>
                    <th scope="col">Műveletek</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <th scope="row">{{ $product->id }}</th>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->unit_price }}</td>
                        <td>{{ $product->unit_price * 3 * 0.9 }}</td>
                        <td>{{ $product->unit_price * 5 * 0.8 }}</td>
                        <td>
                            <a href="{{ route('products.edit', $product->id) }}">Módosítás</a>

                            <form method="post" action="{{ route('products.destroy', $product->id) }}" style="display: inline-block;">
                                @csrf
                                @method('delete')
                                <button type="submit" onclick="return confirm('Biztosan törölni szeretnéd?')">Törlés</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection