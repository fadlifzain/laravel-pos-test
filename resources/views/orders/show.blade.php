@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-semibold mb-4">Order Details</h2>

    <div class="mb-4">
        <p class="text-lg"><strong>Order ID:</strong> {{ $order->id }}</p>
        <p class="text-lg"><strong>Total:</strong> Rp {{ number_format($order->total, 2) }}</p>
        <p class="text-lg"><strong>Created At:</strong> {{ $order->created_at->format('d M Y H:i') }}</p>
    </div>

    <h3 class="text-xl font-semibold mb-3">Items</h3>
    <table class="w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-200">
                <th class="border border-gray-300 p-2">Product</th>
                <th class="border border-gray-300 p-2">Quantity</th>
                <th class="border border-gray-300 p-2">Price</th>
                <th class="border border-gray-300 p-2">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
                <tr>
                    <td class="border border-gray-300 p-2">{{ $item->product->name }}</td>
                    <td class="border border-gray-300 p-2">{{ $item->quantity }}</td>
                    <td class="border border-gray-300 p-2">Rp {{ number_format($item->price, 2) }}</td>
                    <td class="border border-gray-300 p-2">Rp {{ number_format($item->price * $item->quantity, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('orders.index') }}" class="mt-4 inline-block bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700">Back to Orders</a>
</div>
@endsection
