@extends('layout')

@section('content')
<h2>Add Seller</h2>

<form action="{{ route('sellers.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Seller Name</label>
        <input type="text" name="name" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="position" class="form-label">Position</label>
        <textarea name="position" class="form-control"></textarea>
    </div>

    <button type="submit" class="btn btn-success">Save</button>
    <a href="{{ route('sellers.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
