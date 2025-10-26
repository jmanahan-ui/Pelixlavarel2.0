@extends('layout')

@section('content')
<div class="container py-5">
    <div class="card shadow p-4 rounded-4" style="background: white;">
        <h2 class="text-center mb-4" style="color: #a020f0;">Edit Transaction</h2>

        {{-- Edit Transaction Form --}}
        <form action="{{ route('receipts.update', $receipt->id) }}" method="POST" class="row g-3">
            @csrf
            @method('PUT')

            <div class="col-md-6">
                <label class="form-label">Product</label>
                <select name="product_id" class="form-select" required>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}" 
                            {{ $receipt->product_id == $product->id ? 'selected' : '' }}>
                            {{ $product->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label">Seller</label>
                <select name="seller_id" class="form-select" required>
                    @foreach($sellers as $seller)
                        <option value="{{ $seller->id }}" 
                            {{ $receipt->seller_id == $seller->id ? 'selected' : '' }}>
                            {{ $seller->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <label class="form-label">Quantity</label>
                <input type="number" name="quantity" class="form-control" 
                       value="{{ $receipt->quantity }}" required>
            </div>

            <div class="col-md-3">
                <label class="form-label">Price (per item)</label>
                <input type="number" class="form-control" 
                       value="{{ $receipt->product->price }}" readonly>
            </div>

            <div class="col-md-3">
                <label class="form-label">Payment</label>
                <input type="number" name="payment" class="form-control" 
                       value="{{ $receipt->payment }}" required>
            </div>

            <div class="col-md-3">
                <label class="form-label">Change</label>
                <input type="number" class="form-control" 
                       value="{{ $receipt->change }}" readonly>
            </div>

            <div class="col-12 text-center mt-3">
                <button type="submit" class="btn btn-primary px-4 py-2"
                        style="background: linear-gradient(to right, #a020f0, #ff66cc); border: none;">
                    Update Transaction
                </button>
                <a href="{{ route('receipts.index') }}" class="btn btn-secondary ms-2">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
