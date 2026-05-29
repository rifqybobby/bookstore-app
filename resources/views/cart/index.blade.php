@extends('layouts.app')
@section('title', 'Keranjang Belanja')
@section('content')
<div class="page-header">
    <div class="container">
        <h1>🛒 Keranjang Belanja</h1>
        <p>{{ $items->count() }} item di keranjangmu</p>
    </div>
</div>
<div class="container" style="padding-bottom:3rem;">
    @if($items->isEmpty())
    <div class="card" style="padding:4rem;text-align:center;">
        <div style="font-size:4rem;margin-bottom:1rem;">🛒</div>
        <h2 style="font-family:'Playfair Display',serif;margin-bottom:0.5rem;">Keranjang Kosong</h2>
        <p style="color:var(--text-light);margin-bottom:1.5rem;">Belum ada buku yang ditambahkan.</p>
        <a href="{{ route('products.index') }}" class="btn btn-primary">Lihat Katalog</a>
    </div>
    @else
    <div style="display:grid;grid-template-columns:1fr 320px;gap:1.5rem;align-items:start;">
        <div>
            @foreach($items as $item)
            <div class="card" style="margin-bottom:1rem;display:flex;align-items:center;gap:1.5rem;padding:1.2rem;">
                <div style="background:linear-gradient(135deg,var(--brown),#6B4C3B);width:70px;height:90px;border-radius:6px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <span style="font-size:2rem;">📖</span>
                </div>
                <div style="flex:1;">
                    <div style="font-family:'Playfair Display',serif;font-size:1rem;margin-bottom:0.2rem;">{{ $item->book->title }}</div>
                    <div style="color:var(--text-light);font-size:0.85rem;margin-bottom:0.5rem;">{{ $item->book->author }}</div>
                    <div style="font-weight:700;color:var(--brown);">{{ $item->book->price_formatted }}</div>
                </div>
                <div style="display:flex;align-items:center;gap:0.8rem;">
                    <form method="POST" action="{{ route('cart.update', $item) }}">
                        @csrf @method('PATCH')
                        <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="99"
                            style="width:60px;padding:0.4rem;border:1.5px solid var(--border);border-radius:6px;text-align:center;font-size:0.9rem;"
                            onchange="this.form.submit()">
                    </form>
                    <div style="font-weight:700;color:var(--brown);min-width:90px;text-align:right;">
                        Rp {{ number_format($item->book->price * $item->quantity, 0, ',', '.') }}
                    </div>
                    <form method="POST" action="{{ route('cart.remove', $item) }}">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus item ini?')">✕</button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>

        <div class="card" style="padding:1.5rem;position:sticky;top:80px;">
            <h3 style="font-family:'Playfair Display',serif;margin-bottom:1rem;padding-bottom:0.8rem;border-bottom:1px solid var(--border);">Ringkasan Pesanan</h3>
            @foreach($items as $item)
            <div style="display:flex;justify-content:space-between;font-size:0.85rem;margin-bottom:0.5rem;color:var(--text-light);">
                <span>{{ $item->book->title }} x{{ $item->quantity }}</span>
                <span>Rp {{ number_format($item->book->price * $item->quantity, 0, ',', '.') }}</span>
            </div>
            @endforeach
            <div style="border-top:2px solid var(--border);margin-top:1rem;padding-top:1rem;display:flex;justify-content:space-between;font-weight:700;font-size:1.1rem;">
                <span>Total</span>
                <span style="color:var(--brown);">Rp {{ number_format($total, 0, ',', '.') }}</span>
            </div>
            <a href="{{ route('checkout.index') }}" class="btn btn-primary" style="width:100%;text-align:center;margin-top:1.2rem;display:block;">
                Checkout →
            </a>
        </div>
    </div>
    @endif
</div>
@endsection
