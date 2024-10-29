<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" href="{{ asset('icon/logo.svg') }}" type="image/svg+xml">
    <script>
        function toggleDropdown() {
            document.getElementById("userDropdown").classList.toggle("show");
        }

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
            <h2 class="login-title">Sign In</h2>
            <form action="{{ route('authenticate') }}" method="POST">
                @csrf
                <div class="login-group">
                    <label class="login-label" for="email">Email</label>
                    <input type="text" name="email" id="email" required class="input-email" placeholder="Email" />
                </div>
                <div class="login-group">
                    <label class="login-label" for="password">Password</label>
                    <input type="password" name="password" id="password" required class="input-password" placeholder="Password" />
                </div>
                <button type="submit" class="login-button">Sign In</button>
                @error('credentials')
                    <div class="warn">{{ $message }}</div>
                @enderror
                <a href="#" class="forgot-password">Forgot Apple ID or password?</a>
                <a href="{{ route('register') }}" class="forgot-password">Sign Up</a>
            </form>

            <div class="social-login">
                <a href="{{ route('login.google') }}" class="social-button google">
                    <i class="fab fa-google mx-auto"></i>
                </a>
                <a href="{{ route('login.github') }}" class="social-button github">
                    <i class="fab fa-github"></i>
                </a>
            </div>
        </div>
    </div>
</body>
<footer>
    <div class="container">
        &#xA9; Copyright: Project 954348 Web Programming.
    </div>
</footer>
</html>
