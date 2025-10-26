@extends('layout')

@section('content')
<h2>Edit Seller</h2>

<form action="{{ route('sellers.update', $seller) }}" method="POST">
    @csrf @method('PUT')

    <div class="mb-3">
        <label for="name" class="form-label">Seller Name</label>
        <input type="text" name="name" class="form-control" value="{{ $seller->name }}" required>
    </div>

    <div class="mb-3">
        <label for="position" class="form-label">Position</label>
        <textarea name="position" class="form-control">{{ $seller->position }}</textarea>
    </div>

    <button type="submit" class="btn btn-success">Update</button>
    <a href="{{ route('sellers.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
