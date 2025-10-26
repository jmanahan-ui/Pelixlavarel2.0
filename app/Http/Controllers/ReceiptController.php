<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Seller;
use App\Models\Receipt;

class ReceiptController extends Controller
{
    /**
     * Display all receipts and show transaction form
     */
    public function index()
    {
        $receipts = Receipt::with(['product', 'seller'])->latest()->get();
        $products = Product::all();
        $sellers  = Seller::all();

        return view('receipts.index', compact('receipts', 'products', 'sellers'));
    }

    /**
     * Store a new transaction (receipt)
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'seller_id'  => 'required|exists:sellers,id',
            'quantity'   => 'required|integer|min:1',
            'payment'    => 'required|numeric|min:0',
        ]);

        $product = Product::findOrFail($request->product_id);

        // Check stock
        if ($request->quantity > $product->stock) {
            return back()->with('error', 'Not enough stock available.');
        }

        // Compute total and change
        $total  = $product->price * $request->quantity;
        $change = $request->payment - $total;

        // Create new receipt
        Receipt::create([
            'product_id' => $product->id,
            'seller_id'  => $request->seller_id,
            'quantity'   => $request->quantity,
            'total'      => $total,
            'payment'    => $request->payment,
            'change'     => $change,
        ]);

        // Decrease product stock
        $product->decrement('stock', $request->quantity);

        return redirect()->route('receipts.index')->with('success', 'Transaction completed successfully!');
    }

    /**
     * Show edit form for a receipt
     */
    public function edit($id)
    {
        $receipt  = Receipt::findOrFail($id);
        $products = Product::all();
        $sellers  = Seller::all();

        return view('receipts.edit', compact('receipt', 'products', 'sellers'));
    }

    /**
     * Update receipt transaction
     */
    public function update(Request $request, $id)
    {
        $receipt = Receipt::findOrFail($id);
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'seller_id'  => 'required|exists:sellers,id',
            'quantity'   => 'required|integer|min:1',
            'payment'    => 'required|numeric|min:0',
        ]);

        $product = Product::findOrFail($request->product_id);

        // Adjust stock if quantity changed
        $difference = $request->quantity - $receipt->quantity;
        if ($difference > 0 && $difference > $product->stock) {
            return back()->with('error', 'Not enough stock to increase quantity.');
        }

        $product->decrement('stock', $difference > 0 ? $difference : 0);
        if ($difference < 0) {
            $product->increment('stock', abs($difference));
        }

        // Compute new total and change
        $total  = $product->price * $request->quantity;
        $change = $request->payment - $total;

        // Update receipt
        $receipt->update([
            'product_id' => $product->id,
            'seller_id'  => $request->seller_id,
            'quantity'   => $request->quantity,
            'total'      => $total,
            'payment'    => $request->payment,
            'change'     => $change,
        ]);

        return redirect()->route('receipts.index')->with('success', 'Transaction updated successfully!');
    }

    /**
     * Delete a receipt transaction
     */
    public function destroy($id)
    {
        $receipt = Receipt::findOrFail($id);

        // Restore stock when deleting receipt
        if ($receipt->product) {
            $receipt->product->increment('stock', $receipt->quantity);
        }

        $receipt->delete();

        return redirect()->route('receipts.index')->with('success', 'Transaction deleted successfully!');
    }
}
