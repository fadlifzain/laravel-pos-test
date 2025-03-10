@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-xl font-semibold mb-4">Manage Products</h2>

    <a href="{{ route('products.create') }}" class="bg-green-600 text-white py-2 px-4 rounded-lg hover:bg-green-700">
        Add Product
    </a>

    @if(session('success'))
        <p class="mt-4 text-green-600">{{ session('success') }}</p>
    @endif

    <table class="mt-4 w-full border-collapse">
        <thead>
            <tr class="bg-gray-200">
                <th class="p-2 border">Name</th>
                <th class="p-2 border">SKU</th>
                <th class="p-2 border">Price</th>
                <th class="p-2 border">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td class="p-2 border">{{ $product->name }}</td>
                    <td class="p-2 border">{{ $product->sku }}</td>
                    <td class="p-2 border">Rp {{ number_format($product->price, 2) }}</td>
                    <td class="p-2 border">
                        <a href="{{ route('products.edit', $product->id) }}" class="text-blue-600 hover:underline">Edit</a>
                        |
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
