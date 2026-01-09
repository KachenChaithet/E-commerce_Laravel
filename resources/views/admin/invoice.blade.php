<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Invoice</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
        }
    </style>
</head>

<body class="bg-gray-100 p-10">

    <div class="max-w-3xl mx-auto bg-white p-8 border border-gray-300">

        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">INVOICE</h1>
            <p class="text-sm text-gray-500">Order #{{ $data->id }}</p>
        </div>

        <!-- Customer Info -->
        <div class="mb-6">
            <h2 class="text-lg font-semibold mb-2 border-b pb-1">Customer Information</h2>
            <p><span class="font-medium">Name:</span> {{ $data->user->name }}</p>
            <p><span class="font-medium">Address:</span> {{ $data->receiver_address }}</p>
            <p><span class="font-medium">Phone:</span> {{ $data->receiver_phone }}</p>
        </div>

        <!-- Product Table -->
        <div class="mb-6">
            <h2 class="text-lg font-semibold mb-2 border-b pb-1">Order Details</h2>

            <table class="w-full border border-gray-300 text-sm">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="border px-3 py-2 text-left">#</th>
                        <th class="border px-3 py-2 text-left">Product</th>
                        <th class="border px-3 py-2 text-right">Price</th>
                    </tr>
                </thead>
                <tbody>
                    @php $sum = 0; @endphp
                    @foreach ($data->items as $index => $item)
                        @php
                            $sum += $item->product->product_price;
                        @endphp
                        <tr>
                            <td class="border px-3 py-2">{{ $index + 1 }}</td>
                            <td class="border px-3 py-2">{{ $item->product->product_title }}</td>
                            <td class="border px-3 py-2 text-right">{{ number_format($item->product->product_price) }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Total -->
        <div class="text-right">
            <p class="text-lg font-semibold">
                Total Amount: {{ number_format($sum, 2) }} THB
            </p>
        </div>

        <!-- Footer -->
        <div class="mt-10 text-center text-xs text-gray-500">
            Thank you for your purchase
        </div>

    </div>

</body>

</html>
