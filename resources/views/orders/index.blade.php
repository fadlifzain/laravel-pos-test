@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-xl font-semibold mb-4">List of Orders</h2>
    <table class="mt-4 w-full border-collapse">
        <thead>
            <tr class="bg-gray-200">
                <th class="border p-2">Order ID</th>
                <th class="border p-2">Total Amount</th>
                <th class="border p-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr>
                    <td class="border p-2">{{ $order->id }}</td>
                    <td class="border p-2">Rp {{ number_format($order->total, 2) }}</td>
                    <td class="border p-2">
                        <a href="{{ route('orders.show', $order->id) }}" class="text-gray-600 hover:underline">View</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
