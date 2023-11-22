@extends('layouts.app')

@section('content')
    <h1>Új Vásárlás</h1>

    <form method="post" action="{{ route('purchases.store') }}">
        @csrf

        <div id="productFields">
            <div class="form-group product-field">
                <label for="product_id">Termék kiválasztása:</label>
                <select name="product_id[]" required>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                </select>

                <label for="quantity">Mennyiség:</label>
                <input type="number" name="quantity[]" value="1" class="form-control" required>
            </div>
        </div>

        <button type="button" onclick="addProductField()">+</button>

        <p>Teljes rendelés ára: <span id="totalAmount">0</span></p>

        <button type="submit">Mentés</button>

        <script>
            function addProductField() {
                var productField = document.querySelector('.product-field');
                var clone = productField.cloneNode(true);
                document.getElementById('productFields').appendChild(clone);
            }
        </script>

        <script>

            function updateTotalAmount() {
                var totalAmount = 0;
                var quantityFields = document.getElementsByName('quantity[]');
                var productFields = document.getElementsByName('product_id[]');

                for (var i = 0; i < quantityFields.length; i++) {
                    var quantity = parseInt(quantityFields[i].value, 10);
                    var productId = parseInt(productFields[i].value, 10);
                    var product = getProductById(productId);

                    if (product) {
                        totalAmount += quantity * product.unit_price;
                    }
                }

                document.getElementById('totalAmount').innerText = totalAmount;
            }

            function getProductById(productId) {
                var products = [
                    { id: 1, name: 'Termék 1', unit_price: 1000 },
                    { id: 2, name: 'Termék 2', unit_price: 2000 },
                    { id: 3, name: 'Termék 3', unit_price: 3000 }
                ];    

                        for (var i = 0; i < products.length; i++) {
                            if (products[i].id === productId) {
                                return products[i];
                            }
                        }

                return null;
            }

            document.addEventListener('change', function (event) {
                if (event.target && (event.target.name === 'quantity[]' || event.target.name === 'product_id[]')) {
                    updateTotalAmount();
                }
            });

            document.addEventListener('DOMContentLoaded', function () {
                updateTotalAmount();
            });
        </script>
    </form>
@endsection
