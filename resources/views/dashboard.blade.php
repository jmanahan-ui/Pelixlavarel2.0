<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pharmacy Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-purple-100 to-pink-100 text-gray-900 min-h-screen flex flex-col items-center justify-center">

    <div class="text-center mb-10">
        <h1 class="text-4xl font-bold text-purple-700 mb-3">Pharmacy Management System</h1>
        <p class="text-gray-600 text-lg">Welcome to your management dashboard</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 w-11/12 max-w-5xl">
        {{-- Products --}}
        <a href="{{ route('products.index') }}" 
           class="bg-white shadow-lg hover:shadow-2xl transition rounded-2xl p-8 text-center border-2 border-transparent hover:border-purple-400">
            <h2 class="text-2xl font-semibold text-purple-700 mb-2">💊 Products</h2>
            <p class="text-gray-500">Manage your list of medicines and stock levels</p>
        </a>

        {{-- Receipts --}}
        <a href="{{ route('receipts.index') }}" 
           class="bg-white shadow-lg hover:shadow-2xl transition rounded-2xl p-8 text-center border-2 border-transparent hover:border-pink-400">
            <h2 class="text-2xl font-semibold text-pink-600 mb-2">🧾 Receipts</h2>
            <p class="text-gray-500">Record transactions and generate receipts</p>
        </a>

        {{-- Sellers (Optional) --}}
        <a href="{{ route('sellers.index') }}" 
           class="bg-white shadow-lg hover:shadow-2xl transition rounded-2xl p-8 text-center border-2 border-transparent hover:border-indigo-400">
            <h2 class="text-2xl font-semibold text-indigo-600 mb-2">👩‍⚕️ Sellers</h2>
            <p class="text-gray-500">View and manage registered sellers</p>
        </a>
    </div>

</body>
</html>
