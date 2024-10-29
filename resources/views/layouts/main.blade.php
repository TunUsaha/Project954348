<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="{{ asset('css/output.css') }}" rel="stylesheet">
    <link rel="icon" href="{{ asset('icon/logo.svg') }}" type="image/svg+xml">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css">
    <style>
        /* General styling */
        body {
            font-family: Arial, sans-serif;
            color: #333;
            background-color: #f8f8f8;
        }

        /* Header and Navigation styling */
        header {
            background-color: #fff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 10px 0;
        }

        .header-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .Logo img {
            height: 50px;
        }

        nav ul {
            list-style: none;
            display: flex;
            align-items: center;
            gap: 20px;
        }

        nav ul li {
            position: relative;
        }

        nav ul li a.nav-link {
            text-decoration: none;
            color: #333;
            font-size: 16px;
            padding: 10px 0;
            transition: color 0.3s;
        }

        nav ul li a.nav-link:hover {
            color: #0071e3; /* Apple blue color */
        }

        /* Dropdown Menu */
        .dropdown:hover .dropdown-menu {
            display: block;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            background-color: #fff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 10px 0;
        }

        .dropdown-menu li {
            width: 200px;
            padding: 10px;
        }

        .dropdown-menu li a {
            color: #333;
            text-decoration: none;
            display: block;
            padding: 5px 15px;
        }

        .dropdown-menu li a:hover {
            background-color: #f0f0f0;
        }

        /* User and Cart Icon Styling */
        .user-icon, .cart-icon {
            position: relative;
            margin-left: 15px;
            cursor: pointer;
            color: #333;
            font-size: 18px;
        }

        .cart-link {
            color: #333;
            text-decoration: none;
            font-size: 20px;
            position: relative;
        }

        .cart-count {
            position: absolute;
            top: -8px;
            right: -8px;
            background-color: #ff0000;
            color: white;
            border-radius: 50%;
            padding: 2px 6px;
            font-size: 12px;
            font-weight: bold;
        }

        /* Dropdown Content */
        .dropdown-content {
            display: none;
            position: absolute;
            top: 100%;
            right: 0;
            background-color: #fff;
            min-width: 160px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 10px;
            border-radius: 8px;
        }

        .dropdown-content.show {
            display: block;
        }

        .dropdown-content a {
            color: #333;
            text-decoration: none;
            padding: 8px 10px;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #f0f0f0;
        }

        /* Footer Styling */
        footer {
            text-align: center;
            padding: 20px;
            background-color: #333;
            color: #fff;
            font-size: 14px;
        }
    </style>
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
    <header>
        <div class="header-container">
            <div class="Logo">
                <a href="{{ route('welcome') }}">
                    <img src="{{ asset('images/image.png') }}" alt="Logo">
                </a>
            </div>
            <nav>
                <ul>
                    <li><a href="{{ route('products.list') }}" class="nav-link">Store</a></li>
                    <li class="dropdown">
                        <a href="{{ route('welcome') }}" class="nav-link">Mac</a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Macpine Air</a></li>
                            <li><a href="#">Macpine Pro</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="{{ route('welcome') }}" class="nav-link">Pinepad</a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Pinepad</a></li>
                            <li><a href="#">Pinepad Mini</a></li>
                            <li><a href="#">Pinepad Pro</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="nav-link">Watch</a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Pineapple Watch</a></li>
                            <li><a href="#">Pineapple Watch SE</a></li>
                            <li><a href="#">Pineapple Watch Ultra</a></li>
                        </ul>
                    </li>
                    <li><a href="{{ route('welcome') }}" class="nav-link">Contact</a></li>
                    <li>
                        <input type="text" class="input" placeholder="Search"> <span>Search</span>
                    </li>
                    <li>
                        <div class="user-icon" onclick="toggleDropdown()">
                            <i class="fas fa-user"></i>
                            @if(Auth::check())
                                {{ Auth::user()->role }}
                            @else
                                Guest
                            @endif
                        </div>
                        <div class="dropdown-content" id="userDropdown">
                            @if(Auth::check())
                                <p>Logged in as: {{ Auth::user()->name }}</p>
                                @if(Auth::user()->role === 'ADMIN')
                                    <a href="{{ route('users.list') }}">Manage Users</a>
                                @else
                                    <a href="{{ route('users.self', Auth::user()->id) }}">Account</a>
                                @endif
                                <a href="{{ route('logout') }}">Logout</a>
                            @else
                                <p>You are not logged in.</p>
                                <a href="{{ route('login') }}">Login</a>
                            @endif
                        </div>
                    </li>
                    <li>
                        <div class="cart-icon">
                            <a href="{{ route('cart.show') }}" class="cart-link">
                                <i class="fas fa-shopping-cart"></i>
                                <span class="cart-count">{{ session('cart') ? count(session('cart')) : 0 }}</span>
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <div class="container">
            @yield('content')
        </div>
    </main>
    <footer>
        <div class="container">
            &#xA9; {{ date('Y') }} Project 954348 Web Programming.
        </div>
    </footer>
</body>
</html>