@extends('layouts.main')

@section('title', 'About Pineapple')

@section('content')
<div class="container mx-auto p-8">
    <!-- Hero Section -->
    <section class="hero h-96 flex flex-col items-center justify-center bg-gradient-to-r from-gray-100 to-gray-300 rounded-lg shadow-lg p-6 mb-12">
        <h1 class="text-6xl font-semibold text-gray-800 mb-4">About Pineapple</h1>
        <p class="text-2xl text-gray-600">Innovating for a Better World</p>
    </section>

    <!-- About Section -->
    <section class="about-us mb-16">
        <h2 class="text-4xl font-bold text-gray-900 mb-6">Who We Are</h2>
        <p class="text-lg text-gray-700 leading-relaxed">
            Founded with a commitment to design and innovation, Pineapple has become a global leader in technology. Our mission is to empower individuals through beautifully designed, high-performance products that enhance lives. Inspired by the likes of Apple Inc., we aim to bring a user-friendly experience to every aspect of our products.
        </p>
    </section>

    <!-- History Section -->
    <section class="history mb-16">
        <h2 class="text-4xl font-bold text-gray-900 mb-6">Our Journey</h2>
        <p class="text-lg text-gray-700 leading-relaxed mb-4">
            Since our inception, Pineapple has been at the forefront of innovation. Like Apple, we believe in “thinking differently,” prioritizing seamless design, user privacy, and advanced functionality in each product. From the Pinepad tablet series to Pinewatch wearables, we’ve continued to push boundaries, transforming industries with each release.
        </p>
    </section>

    <!-- Products Section -->
    <section class="products mb-16">
        <h2 class="text-4xl font-bold text-gray-900 mb-6">Our Products</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Pinepad -->
            <div class="product bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-transform transform hover:scale-105">
                <h3 class="text-3xl font-bold text-gray-800 mb-4">Pinepad</h3>
                <p class="text-lg text-gray-600">Our premium tablet designed for productivity and creativity on the go, with an emphasis on performance and style.</p>
            </div>
            <!-- Macpine -->
            <div class="product bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-transform transform hover:scale-105">
                <h3 class="text-3xl font-bold text-gray-800 mb-4">Macpine</h3>
                <p class="text-lg text-gray-600">The ultimate laptop experience, combining powerful performance with sleek design and portability, perfect for professionals and creators.</p>
            </div>
            <!-- Pinewatch -->
            <div class="product bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-transform transform hover:scale-105">
                <h3 class="text-3xl font-bold text-gray-800 mb-4">Pinewatch</h3>
                <p class="text-lg text-gray-600">Our wearable technology designed to keep you connected, with advanced health tracking and personal assistant features.</p>
            </div>
        </div>
    </section>

    <!-- Philosophy Section -->
    <section class="philosophy mb-16">
        <h2 class="text-4xl font-bold text-gray-900 mb-6">Our Philosophy</h2>
        <p class="text-lg text-gray-700 leading-relaxed">
            At Pineapple, we believe technology should be simple, powerful, and accessible to everyone. Our design philosophy emphasizes minimalism, functionality, and user privacy. By focusing on the details, we aim to build products that not only look beautiful but enhance the lives of our users. Inspired by Apple’s commitment to quality and sustainability, we strive to make a positive impact on both people and the planet.
        </p>
    </section>

    <!-- Call-to-Action Section -->
    <section class="cta-section py-16 bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg shadow-lg text-center">
        <h2 class="text-4xl font-semibold text-white mb-4">Ready to Experience Pineapple?</h2>
        <p class="text-lg text-white mb-8">Discover the technology that brings your ideas to life.</p>
        <a href="{{ route('products.list') }}" class="bg-white text-blue-700 font-medium text-lg px-8 py-3 rounded-full hover:bg-gray-200 transition-all duration-300 shadow-lg transform hover:scale-105">Shop Now</a>
    </section>
</div>
@endsection