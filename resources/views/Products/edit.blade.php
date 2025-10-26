@extends('layout')

@section('content')
    <h2>Edit Product</h2>

    @if ($errors->any())
        <div class="alert-success" style="background-color: rgba(255,0,0,0.1); border: 1px solid #e57373;">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="name">Product Name</label>
        <input type="text" name="name" value="{{ $product->name }}" required>

        <label for="price">Price (₱)</label>
        <input type="number" name="price" value="{{ $product->price }}" min="0" step="0.01" required>

        <label for="stock">Stock</label>
        <input type="number" name="stock" value="{{ $product->stock }}" min="0" required>

        <div style="text-align: right;">
            <a href="{{ route('products.index') }}" class="btn btn-dark">Cancel</a>
            <button type="submit" class="btn btn-secondary">Update Product</button>
        </div>
    </form>
@endsection
