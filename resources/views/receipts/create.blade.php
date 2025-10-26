@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4 text-pink-600">💵 Create New Receipt</h2>

    <form action="{{ route('receipts.store') }}" method="POST" id="receiptForm">
        @csrf

        <div class="mb-3">
            <label for="product_id" class="form-label">Product</label>
            <select name="product_id" id="product_id" class="form-select" required>
                <option value="">Select Product</option>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}" data-price="{{ $product->price }}">
                        {{ $product->name }} (₱{{ number_format($product->price, 2) }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Price</label>
            <input type="number" name="price" id="price" class="form-control" readonly>
        </div>

        <div class="mb-3">
            <label class="form-label">Quantity</label>
            <input type="number" name="quantity" id="quantity" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Total</label>
            <input type="number" name="total" id="total" class="form-control" readonly>
        </div>

        <div class="mb-3">
            <label class="form-label">Payment</label>
            <input type="number" name="payment" id="payment" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Change</label>
            <input type="number" name="change" id="change" class="form-control" readonly>
        </div>

        <button type="submit" class="btn btn-success w-100">Submit</button>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const productSelect = document.getElementById('product_id');
    const priceInput = document.getElementById('price');
    const quantityInput = document.getElementById('quantity');
    const totalInput = document.getElementById('total');
    const paymentInput = document.getElementById('payment');
    const changeInput = document.getElementById('change');

    productSelect.addEventListener('change', function() {
        const selectedOption = productSelect.options[productSelect.selectedIndex];
        const price = selectedOption.getAttribute('data-price');
        priceInput.value = price || '';
        calculateTotal();
    });

    quantityInput.addEventListener('input', calculateTotal);
    paymentInput.addEventListener('input', calculateChange);

    function calculateTotal() {
        const price = parseFloat(priceInput.value) || 0;
        const quantity = parseInt(quantityInput.value) || 0;
        totalInput.value = price * quantity;
        calculateChange();
    }

    function calculateChange() {
        const payment = parseFloat(paymentInput.value) || 0;
        const total = parseFloat(totalInput.value) || 0;
        changeInput.value = payment - total;
    }
});
</script>
@endsection
