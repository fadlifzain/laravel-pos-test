@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-xl font-semibold mb-4">Add Product</h2>

    <form action="{{ route('products.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700">Name</label>
            <input type="text" name="name" class="w-full p-2 border rounded" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">SKU</label>
            <input type="text" name="sku" class="w-full p-2 border rounded" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Price</label>
            <input type="number" name="price" class="w-full p-2 border rounded" required>
        </div>
        <button type="submit" class="bg-green-600 text-white py-2 px-4 rounded-lg hover:bg-green-700">
            Save
        </button>
    </form>
</div>
@endsection
