@extends('layout')

@section('content')
    <h2>Product List</h2>

    {{-- Success Message --}}
    @if (session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <div>
            <a href="{{ route('products.create') }}" class="btn btn-success">Add New Product</a>
        </div>

        <div style="display: flex; gap: 10px;">
            <a href="{{ url('/') }}" class="btn btn-dark">Dashboard</a>
            <a href="{{ route('receipts.index') }}" class="btn btn-secondary">Receipts</a>
            <a href="{{ route('sellers.index') }}" class="btn btn-warning">Sellers</a>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price (₱)</th>
                <th>Stock</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>₱{{ number_format($product->price, 2) }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>
                        <a href="{{ route('products.edit', $product) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('products.destroy', $product) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Are you sure you want to delete this product?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" style="text-align: center; color: #777;">No products found</td></tr>
            @endforelse
        </tbody>
    </table>
@endsection
