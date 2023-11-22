<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class PurchaseController extends Controller
{
    public function index()
    {
        $purchases = Purchase::all();
        return view('purchases.index', compact('purchases'));
    }

    public function create()
    {
        $products = Product::all();
        return view('purchases.create', compact('products'));
    }

    public function store(Request $request)
{
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'quantity' => 'required|integer|min:1',
    ]);

    $product = Product::find($request->input('product_id'));
    $total = $product->unit_price * $request->input('quantity');

    $purchase = Purchase::create([
        'user_id' => Auth::id(),
        'product_id' => $request->input('product_id'),
        'quantity' => $request->input('quantity'),
        'total_amount' => $total,
        'status' => 'draft',
    ]);

    return redirect()->route('purchases.index')->with('success', 'Vásárlás sikeresen létrehozva!');
}

public function confirmPurchase($id)
{
    $purchase = Purchase::find($id);

    if ($purchase->status === 'draft') {

        $purchase->update(['status' => 'confirmed']);

        return redirect()->route('purchases.index')->with('success', 'Vásárlás véglegesítve!');
    }

    return redirect()->route('purchases.index')->with('error', 'A vásárlás már véglegesítve van!');
}

public function destroy($id)
{
    $purchase = Purchase::find($id);
    $purchase->delete();

    return redirect()->route('purchases.index')->with('success', 'Vásárlás sikeresen törölve!');
}

    public function edit($id)
    {
        $purchase = Purchase::find($id);
        $products = Product::all();

        return view('purchases.edit', compact('purchase', 'products'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $purchase = Purchase::find($id);
        $product = Product::find($purchase->product_id);
        $total = $product->unit_price * $request->input('quantity');

        $purchase->update([
            'quantity' => $request->input('quantity'),
            'total' => $total,
        ]);

        return redirect()->route('purchases.index')->with('success', 'Vásárlás sikeresen módosítva!');
    }
}
