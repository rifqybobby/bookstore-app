@extends('layouts.app')
@section('title', $book->title)
@section('content')
<div class="container" style="padding-top:2rem;padding-bottom:3rem;">
    <a href="{{ route('products.index') }}" style="color:var(--amber);text-decoration:none;font-size:0.9rem;">← Kembali ke Katalog</a>
    <div class="card" style="margin-top:1.5rem;display:flex;gap:0;overflow:hidden;">
        <div style="background:linear-gradient(135deg,var(--brown),#6B4C3B);min-width:280px;display:flex;flex-direction:column;align-items:center;justify-content:center;padding:3rem 2rem;text-align:center;">
            <div style="font-size:5rem;margin-bottom:1rem;">📖</div>
            <div style="font-family:'Playfair Display',serif;color:var(--amber-light);font-size:1.1rem;line-height:1.4;">{{ $book->title }}</div>
        </div>
        <div style="padding:2.5rem;flex:1;">
            <div style="font-size:0.8rem;font-weight:700;color:var(--amber);text-transform:uppercase;letter-spacing:1px;margin-bottom:0.5rem;">{{ $book->category }}</div>
            <h1 style="font-family:'Playfair Display',serif;font-size:1.8rem;margin-bottom:0.4rem;">{{ $book->title }}</h1>
            <p style="color:var(--text-light);margin-bottom:1.5rem;">oleh <strong>{{ $book->author }}</strong></p>
            <p style="color:var(--text-light);line-height:1.7;margin-bottom:2rem;">{{ $book->description ?? 'Tidak ada deskripsi.' }}</p>
            <div style="display:flex;align-items:center;gap:2rem;margin-bottom:2rem;">
                <div>
                    <div style="font-size:0.8rem;color:var(--text-light);">Harga</div>
                    <div style="font-size:1.8rem;font-weight:700;color:var(--brown);">{{ $book->price_formatted }}</div>
                </div>
                <div>
                    <div style="font-size:0.8rem;color:var(--text-light);">Stok</div>
                    <div style="font-size:1.1rem;font-weight:600;color:var(--green);">{{ $book->stock }} tersisa</div>
                </div>
            </div>
            @auth
            <form method="POST" action="{{ route('cart.add', $book) }}">
                @csrf
                <button type="submit" class="btn btn-primary" style="font-size:1rem;padding:0.8rem 2rem;">🛒 Tambah ke Cart</button>
            </form>
            @else
            <a href="{{ route('login') }}" class="btn btn-primary" style="font-size:1rem;padding:0.8rem 2rem;">Login untuk Beli</a>
            @endauth
        </div>
    </div>
</div>
@endsection
