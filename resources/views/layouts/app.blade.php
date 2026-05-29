<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Bukuku - @yield('title', 'Toko Buku Online')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --cream: #F7F3ED;
            --brown: #3D2B1F;
            --amber: #C8882A;
            --amber-light: #E8A84A;
            --text: #2C1E14;
            --text-light: #7A6458;
            --border: #E0D5C8;
            --white: #FFFFFF;
            --red: #B94040;
            --green: #3D7A56;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'DM Sans', sans-serif; background: var(--cream); color: var(--text); min-height: 100vh; }
        nav { background: var(--brown); padding: 0 2rem; display: flex; align-items: center; justify-content: space-between; height: 64px; position: sticky; top: 0; z-index: 100; box-shadow: 0 2px 12px rgba(0,0,0,0.2); }
        .nav-brand { font-family: 'Playfair Display', serif; font-size: 1.6rem; color: var(--amber-light); text-decoration: none; }
        .nav-links { display: flex; align-items: center; gap: 1.5rem; }
        .nav-links a { color: #D4C4B5; text-decoration: none; font-size: 0.9rem; font-weight: 500; transition: color 0.2s; }
        .nav-links a:hover { color: var(--amber-light); }
        .cart-icon { background: var(--amber); color: white !important; padding: 0.4rem 1rem; border-radius: 20px; font-weight: 600 !important; }
        .flash { padding: 0.8rem 1.5rem; margin: 1rem 2rem; border-radius: 8px; font-size: 0.9rem; font-weight: 500; }
        .flash-success { background: #D4EDDA; color: var(--green); border-left: 4px solid var(--green); }
        .flash-error { background: #F8D7DA; color: var(--red); border-left: 4px solid var(--red); }
        main { min-height: calc(100vh - 128px); }
        .container { max-width: 1200px; margin: 0 auto; padding: 0 2rem; }
        .btn { display: inline-block; padding: 0.6rem 1.4rem; border-radius: 6px; font-family: 'DM Sans', sans-serif; font-size: 0.9rem; font-weight: 600; cursor: pointer; border: none; transition: all 0.2s; text-decoration: none; }
        .btn-primary { background: var(--amber); color: white; }
        .btn-primary:hover { background: var(--amber-light); color: var(--brown); }
        .btn-outline { background: transparent; border: 2px solid var(--amber); color: var(--amber); }
        .btn-outline:hover { background: var(--amber); color: white; }
        .btn-danger { background: var(--red); color: white; }
        .btn-sm { padding: 0.35rem 0.9rem; font-size: 0.82rem; }
        .page-header { background: var(--brown); color: white; padding: 2.5rem 2rem; margin-bottom: 2rem; }
        .page-header h1 { font-family: 'Playfair Display', serif; font-size: 2rem; color: var(--amber-light); }
        .card { background: white; border-radius: 12px; border: 1px solid var(--border); overflow: hidden; }
        footer { background: var(--brown); color: #C4B4A5; text-align: center; padding: 1.5rem; font-size: 0.85rem; }
        footer span { color: var(--amber-light); }
        .form-group { margin-bottom: 1.2rem; }
        .form-group label { display: block; font-weight: 600; font-size: 0.875rem; margin-bottom: 0.4rem; }
        .form-group input, .form-group select { width: 100%; padding: 0.65rem 1rem; border: 1.5px solid var(--border); border-radius: 8px; font-family: 'DM Sans', sans-serif; font-size: 0.9rem; background: white; color: var(--text); }
        .form-group input:focus, .form-group select:focus { outline: none; border-color: var(--amber); }
        .form-error { color: var(--red); font-size: 0.8rem; margin-top: 0.3rem; }
        .invalid { border-color: var(--red) !important; }
    </style>
    @yield('styles')
</head>
<body>
<nav>
    <a href="{{ route('home') }}" class="nav-brand">📚 Bukuku</a>
    <div class="nav-links">
        <a href="{{ route('products.index') }}">Katalog</a>
        @auth
            <a href="{{ route('cart.index') }}" class="cart-icon">🛒 Cart</a>
            <a href="#">{{ Auth::user()->name }}</a>
            <form method="POST" action="{{ route('logout') }}" style="display:inline">
                @csrf
                <button type="submit" style="background:none;border:none;cursor:pointer;color:#D4C4B5;font-size:0.9rem;font-weight:500;">Logout</button>
            </form>
        @else
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register') }}" class="cart-icon">Daftar</a>
        @endauth
    </div>
</nav>
<main>
    @if(session('success'))
        <div class="flash flash-success">✅ {{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="flash flash-error">❌ {{ session('error') }}</div>
    @endif
    @yield('content')
</main>
<footer>
    <p>© {{ date('Y') }} <span>Bukuku</span> — Toko Buku Online</p>
</footer>
</body>
</html>