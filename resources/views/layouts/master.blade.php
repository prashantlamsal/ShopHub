<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    @php
        $categories = \App\Models\Category::orderBy('order', 'asc')->get();
    @endphp
    <nav class="flex justify-between items-center bg-blue-600 py-3 px-12 text-white">
        <h2 class="font-bold text-xl">LOGO</h2>
        <div class="flex gap-4">
            <a href="/">Home</a>
            @foreach ($categories as $category)
                <a href="">{{$category->name}}</a>
            @endforeach
            <a href="/login">Login</a>
        </div>
    </nav>
    @yield('content')
    <footer class="bg-gray-700 text-white py-3 px-12">
        <div class="text-center">
            <p>&copy; 2025 My Company</p>
        </div>
    </footer>
</body>
</html>
