@extends('layouts.main')

@section('title', 'Welcome to Pineapple')

@section('content')

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pineapple Store - MacBook</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body class="bg-gray-100 text-gray-800 antialiased">
    <!-- Hero Section with Gradient Background and Centered Content -->
    <section class="hero h-screen flex flex-col items-center justify-center bg-gradient-to-br from-blue-500 to-purple-600">
        <div class="text-center z-10 p-10 bg-white bg-opacity-90 rounded-lg shadow-lg transform hover:scale-105 transition-transform duration-300 ease-in-out max-w-xl">
            <h1 class="text-6xl font-bold text-gray-900 mb-4">Welcome to Pineapple</h1>
            <p class="text-2xl text-gray-700 mb-8">Premium products crafted with elegance and performance in mind.</p>
            <a href="{{ route('products.list') }}" class="inline-block bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold text-lg px-12 py-4 rounded-full hover:from-indigo-600 hover:to-blue-500 transition-all duration-300 shadow-lg transform hover:scale-105">Explore Our Products</a>
        </div>
    </section>

    <!-- MacBook Details Section -->
    <section class="macbook-details py-24 bg-gray-50">
        <div class="container mx-auto px-6 text-center md:text-left">
            <h2 class="text-5xl font-bold text-gray-900 mb-12">Discover the MacBook</h2>
            <div class="flex flex-col md:flex-row items-center md:space-x-12">
                
                <!-- MacBook Image -->
                <div class="w-full md:w-1/5 lg:w-1/8 mb-8 mx-auto">
                    <img src="{{ asset('images/macbookair.jpeg') }}" alt="MacBook" class="rounded-lg shadow-lg w-full md:w-4/5 lg:w-full transform hover:scale-105 transition-transform duration-300">
                </div>

                <!-- MacBook Details -->
                <div class="w-full md:w-3/5 text-center md:text-left">
                    <h3 class="text-4xl font-bold text-gray-800 mb-6">Experience Power and Performance</h3>
                    <p class="text-lg text-gray-600 mb-6">The MacBook combines sleek design with powerful performance, making it the ultimate choice for professionals, creatives, and students alike. With its M-series chip, stunning Retina display, and long-lasting battery, MacBook elevates your work and entertainment experiences.</p>
                    
                    <!-- Key Features List -->
                    <ul class="text-left space-y-3 text-gray-700 mb-8">
                        <li><strong>Design:</strong> Ultra-thin, lightweight, and crafted with precision for a premium feel.</li>
                        <li><strong>Performance:</strong> Equipped with the Apple M1/M2 chip, delivering faster processing and graphics.</li>
                        <li><strong>Display:</strong> Retina display with True Tone technology and vivid color accuracy.</li>
                        <li><strong>Battery Life:</strong> Up to 20 hours of battery life, ideal for all-day use.</li>
                        <li><strong>Keyboard and Trackpad:</strong> Magic Keyboard with improved typing experience and large Force Touch trackpad.</li>
                    </ul>

                    <!-- Call-to-Action Button -->
                    <a href="{{ route('products.list') }}" class="inline-block bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-medium text-lg px-10 py-4 rounded-full hover:from-indigo-600 hover:to-blue-500 transition-all duration-300 shadow-lg transform hover:scale-105">Shop MacBook</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Call-to-Action Section -->
    <section class="cta-section py-24 bg-gray-900">
        <div class="container mx-auto px-4 text-center">
            <a href="{{ route('products.list') }}" class="inline-block bg-white text-gray-900 font-medium text-lg px-12 py-4 rounded-full hover:bg-gray-200 transition-all duration-300 shadow-lg transform hover:scale-105">Shop Now</a>
        </div>
    </section>

    <!-- JavaScript for Mobile Menu Toggle -->
    <script>
        const hamburgerBtn = document.getElementById('hamburger-btn');
        const mobileNav = document.getElementById('mobile-nav');

        hamburgerBtn.addEventListener('click', function () {
            mobileNav.classList.toggle('show');
            document.body.classList.toggle('menu-open');
        });

        document.addEventListener('click', function (e) {
            if (!mobileNav.contains(e.target) && !hamburgerBtn.contains(e.target)) {
                if (mobileNav.classList.contains('show')) {
                    mobileNav.classList.remove('show');
                    document.body.classList.remove('menu-open');
                }
            }
        });
    </script>
</body>
@endsection