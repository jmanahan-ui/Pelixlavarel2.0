@extends('layout')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h2>Sellers List</h2>
    <div>
        <a href="{{ route('dashboard') }}" class="btn btn-dark me-2">⬅ Back to Dashboard</a>
        <a href="{{ route('products.index') }}" class="btn btn-secondary me-2">View Products</a>
        <a href="{{ route('sellers.create') }}" class="btn btn-primary">+ Add Seller</a>
    </div>
</div>

<table class="table table-bordered">
    <tr>
        <th>Name</th>
        <th>Position</th>
        <th>Actions</th>
    </tr>
    @foreach($sellers as $seller)
    <tr>
        <td>{{ $seller->name }}</td>
        <td>{{ $seller->position }}</td>
        <td>
            <a href="{{ route('sellers.edit', $seller) }}" class="btn btn-sm btn-warning">Edit</a>
            <form action="{{ route('sellers.destroy', $seller) }}" method="POST" class="d-inline">
                @csrf 
                @method('DELETE')
                <button type="submit" onclick="return confirm('Delete this seller?')" class="btn btn-sm btn-danger">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection
