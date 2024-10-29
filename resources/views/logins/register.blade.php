<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" href="{{ asset('icon/logo.svg') }}" type="image/svg+xml">

    <script>
        function toggleDropdown() {
            document.getElementById("userDropdown").classList.toggle("show");
        }

        // Close the dropdown if the user clicks outside of it
        window.onclick = function(event) {
            if (!event.target.matches('.user-icon')) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                for (var i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }
    </script>
</head>

<body>
    <div class="login-container">
        <div class="login-box">
            <h2 class="login-title">Create your account</h2>

            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            <form class="mt-8 space-y-6" action="{{ route('register') }}" method="POST">
                @csrf
                <div>
                    <div class="login-group">
                        <label for="name" class="login-label">Name</label>
                        <input id="name" name="name" type="text" required class="input-email"
                            placeholder="Full name" value="{{ old('name') }}" aria-label="Full name">
                    </div>
                    <div class="login-group">
                        <label for="email" class="login-label">Email address</label>
                        <input id="email" name="email" type="email" autocomplete="email" required
                            class="input-email" placeholder="Email address" value="{{ old('email') }}" aria-label="Email address">
                    </div>
                    <div class="login-group">
                        <label for="password" class="login-label">Password</label>
                        <input id="password" name="password" type="password" autocomplete="new-password" required
                            class="input-password" placeholder="Password" aria-label="Password">
                    </div>
                    <div class="login-group">
                        <label for="password_confirmation" class="login-label">Confirm Password</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" required
                            class="input-password" placeholder="Confirm password" aria-label="Confirm Password">
                    </div>
                </div>

                <div>
                    <button type="submit" class="login-button" aria-label="Register">
                        Register
                    </button>
                </div>
            </form>

            <div class="mt-6">
                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-300"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-gray-50 text-gray-500">
                            Or continue with
                        </span>
                    </div>
                </div>

                <div class="social-login">
                    <a href="{{ route('login.google') }}" class="social-button google" aria-label="Login with Google">
                        <i class="fab fa-google mx-auto"></i>
                    </a>
                    <a href="{{ route('login.github') }}" class="social-button github" aria-label="Login with GitHub">
                        <i class="fab fa-github"></i>
                    </a>
                </div>

                <p class="mt-2 text-center text-sm text-gray-600">
                    Already have an account?
                    <a href="{{ route('login') }}" class="font-medium text-indigo-600 hover:text-indigo-500">
                        Sign in
                    </a>
                </p>
            </div>
        </div>
    </div>

    <footer>
        <div class="container">
            &#xA9; Copyright: Project 954348 Web Programming.
        </div>
    </footer>
</body>

</html>
