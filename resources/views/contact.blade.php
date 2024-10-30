@extends('layouts.main')

@section('content')
<div class="contact-container">
    <h1 class="contact-title">Contact Us</h1>
    <p class="contact-subtitle">We'd love to hear from you!</p>

    @if(session('success'))
        <div class="contact-alert">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('contact.send') }}" method="POST" class="contact-form">
        @csrf
        <div class="form-group">
            <label for="name">Your Name</label>
            <input type="text" name="name" id="name" class="input-email" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class=input-email" required>
        </div>

        <div class="form-group">
            <label for="message">Message</label>
            <textarea name="message" id="message" class="form-control" rows="4" required></textarea>
        </div>

        <button type="submit" class="contact-btn">Send Message</button>
    </form>
</div>

@endsection
