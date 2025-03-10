@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-xl font-semibold mb-4">Checked-Out Orders</h2>
    <table class="w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-200">
                <th class="border border-gray-300 p-2">Order ID</th>
                <th class="border border-gray-300 p-2">Total Amount</th>
                <th class="border border-gray-300 p-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr>
                    <td class="border border-gray-300 p-2">{{ $order->id }}</td>
                    <td class="border border-gray-300 p-2">Rp {{ number_format($order->total, 2) }}</td>
                    <td class="border border-gray-300 p-2">
                        <a href="{{ route('orders.show', $order->id) }}" class="bg-blue-500 text-white px-3 py-1 rounded-lg">View</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
