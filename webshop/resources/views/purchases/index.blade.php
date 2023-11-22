@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Vásárlások</h2>
        <a class="nav-link" href="{{ route('purchases.create') }}">Új vásárlás</a>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Termék</th>
                    <th scope="col">Mennyiség</th>
                    <th scope="col">Összeg</th>
                    <th scope="col">Státusz</th>
                    <th scope="col">Műveletek</th>
                </tr>
            </thead>
            <tbody>
                @foreach($purchases as $purchase)
                    <tr>
                        <th scope="row">{{ $purchase->id }}</th>
                        <td>{{ $purchase->product->name }}</td>
                        <td>{{ $purchase->quantity }}</td>
                        <td>{{ $purchase->total_amount }}</td>
                        <td>{{ $purchase->status }}</td> 

                        <td>
                            <form method="post" action="{{ route('purchases.destroy', $purchase->id) }}" style="display: inline-block;">
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
