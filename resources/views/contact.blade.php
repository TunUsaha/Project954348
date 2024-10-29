@extends('layouts.main')

@section('content')
<div class="container mt-5">
    <h1>Contact Us</h1>
    <p>We'd love to hear from you!</p>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('contact.send') }}" method="POST">
        @csrf
        <div class="form-group mt-3">
            <label for="name">Your Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        
        <div class="form-group mt-3">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>

        <div class="form-group mt-3">
            <label for="message">Message</label>
            <textarea name="message" id="message" class="form-control" rows="4" required></textarea>
        </div>
        
        <button type="submit" class="btn btn-primary mt-3">Send Message</button>
    </form>
</div>
@endsection
