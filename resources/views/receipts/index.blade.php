@extends('layout')

@section('content')
<div class="container py-5">
    <div class="card shadow p-4 rounded-4" style="background: white;">
        <h2 class="text-center mb-4" style="color: #a020f0;">Receipt Transactions</h2>

        {{-- Transaction Form --}}
        <form action="{{ route('receipts.store') }}" method="POST" class="row g-3">
            @csrf
            <div class="col-md-6">
                <label class="form-label">Product</label>
                <select name="product_id" class="form-select" required>
                    <option value="">-- Select Product --</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label">Seller</label>
                <select name="seller_id" class="form-select" required>
                    <option value="">-- Select Seller --</option>
                    @foreach($sellers as $seller)
                        <option value="{{ $seller->id }}">{{ $seller->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <label class="form-label">Quantity</label>
                <input type="number" name="quantity" class="form-control" required>
            </div>

            <div class="col-md-3">
                <label class="form-label">Price</label>
                <input type="number" name="price" class="form-control" readonly>
            </div>

            <div class="col-md-3">
                <label class="form-label">Payment</label>
                <input type="number" name="payment" class="form-control" required>
            </div>

            <div class="col-md-3">
                <label class="form-label">Change</label>
                <input type="number" name="change" class="form-control" readonly>
            </div>

            <div class="col-12 text-center mt-3">
                <button type="submit" class="btn btn-primary px-4 py-2"
                        style="background: linear-gradient(to right, #a020f0, #ff66cc); border: none;">
                    Complete Transaction
                </button>
            </div>
        </form>
    </div>

    {{-- Transaction History --}}
    <div class="mt-5">
        <h3 style="color: #a020f0;">Transaction History</h3>
        <table class="table table-bordered table-hover mt-3 bg-white rounded-3">
            <thead class="table-light">
                <tr class="text-center">
                    <th>Product</th>
                    <th>Seller</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Payment</th>
                    <th>Change</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($receipts as $receipt)
                    <tr class="text-center">
                        <td>{{ $receipt->product->name }}</td>
                        <td>{{ $receipt->seller->name }}</td>
                        <td>{{ $receipt->quantity }}</td>
                        <td>₱{{ number_format($receipt->total, 2) }}</td>
                        <td>₱{{ number_format($receipt->payment, 2) }}</td>
                        <td>₱{{ number_format($receipt->change, 2) }}</td>
                        <td>{{ $receipt->created_at->format('Y-m-d H:i') }}</td>
                        <td>
                            <a href="{{ route('receipts.edit', $receipt->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('receipts.destroy', $receipt->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure you want to delete this transaction?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted">No transactions yet</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Navigation Buttons --}}
    <div class="d-flex justify-content-end gap-2 mt-4">
        <a href="{{ url('/') }}" class="btn btn-dark">Dashboard</a>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Products</a>
        <a href="{{ route('sellers.index') }}" class="btn btn-warning">Sellers</a>
    </div>
</div>

{{-- JavaScript for auto-calculations --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    const products = @json($products);
    const productSelect = document.querySelector('select[name="product_id"]');
    const priceInput = document.querySelector('input[name="price"]');
    const quantityInput = document.querySelector('input[name="quantity"]');
    const paymentInput = document.querySelector('input[name="payment"]');
    const changeInput = document.querySelector('input[name="change"]');

    function updatePrice() {
        const productId = productSelect.value;
        const product = products.find(p => p.id == productId);
        priceInput.value = product ? product.price : '';
        updateChange();
    }

    function updateChange() {
        const price = parseFloat(priceInput.value) || 0;
        const quantity = parseInt(quantityInput.value) || 0;
        const total = price * quantity;
        const payment = parseFloat(paymentInput.value) || 0;
        changeInput.value = payment - total >= 0 ? (payment - total).toFixed(2) : 0;
    }

    productSelect.addEventListener('change', updatePrice);
    quantityInput.addEventListener('input', updateChange);
    paymentInput.addEventListener('input', updateChange);
});
</script>
@endsection
