@extends('layouts.app')
@section('title', 'Katalog Buku')
@section('styles')
<style>
.filters {
    background: white;
    border: 1px solid var(--border);
    border-radius: 12px;
    padding: 1.2rem 1.5rem;
    margin-bottom: 1.5rem;
    display: flex;
    gap: 1rem;
    align-items: center;
    flex-wrap: wrap;
}
.filters select {
    padding: 0.5rem 1rem;
    border: 1.5px solid var(--border);
    border-radius: 8px;
    font-family: 'DM Sans', sans-serif;
    font-size: 0.875rem;
    background: white;
    color: var(--text);
    cursor: pointer;
}
.filters select:focus { outline: none; border-color: var(--amber); }
.filters label { font-weight: 600; font-size: 0.875rem; color: var(--text-light); }
.book-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}
.book-card {
    background: white;
    border-radius: 12px;
    border: 1px solid var(--border);
    overflow: hidden;
    transition: transform 0.2s, box-shadow 0.2s;
}
.book-card:hover { transform: translateY(-4px); box-shadow: 0 8px 24px rgba(0,0,0,0.1); }
.book-cover {
    height: 180px;
    background: linear-gradient(135deg, var(--brown) 0%, #6B4C3B 100%);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 1rem;
    text-align: center;
}
.book-cover-emoji { font-size: 3rem; margin-bottom: 0.5rem; }
.book-cover-title { color: var(--amber-light); font-family: 'Playfair Display', serif; font-size: 0.85rem; line-height: 1.3; }
.book-info { padding: 1.2rem; }
.book-category {
    font-size: 0.75rem;
    font-weight: 600;
    color: var(--amber);
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 0.3rem;
}
.book-title { font-family: 'Playfair Display', serif; font-size: 1rem; margin-bottom: 0.2rem; line-height: 1.3; }
.book-author { font-size: 0.8rem; color: var(--text-light); margin-bottom: 0.8rem; }
.book-footer { display: flex; align-items: center; justify-content: space-between; }
.book-price { font-weight: 700; color: var(--brown); font-size: 0.95rem; }
.pagination { display: flex; gap: 0.5rem; justify-content: center; margin: 1rem 0 2rem; }
.pagination a, .pagination span {
    padding: 0.4rem 0.9rem;
    border-radius: 6px;
    border: 1.5px solid var(--border);
    font-size: 0.85rem;
    text-decoration: none;
    color: var(--text);
}
.pagination .active span { background: var(--amber); color: white; border-color: var(--amber); }
.hero {
    background: linear-gradient(135deg, var(--brown) 0%, #5C3D2E 100%);
    padding: 3rem 2rem;
    margin-bottom: 2rem;
    text-align: center;
}
.hero h1 { font-family: 'Playfair Display', serif; font-size: 2.5rem; color: var(--amber-light); margin-bottom: 0.5rem; }
.hero p { color: #C4B4A5; font-size: 1rem; }
</style>
@endsection
@section('content')
<div class="hero">
    <h1>Temukan Buku Favoritmu</h1>
    <p>Koleksi buku pilihan dengan harga terbaik</p>
</div>
<div class="container">
    <form class="filters" method="GET">
        <label>Filter:</label>
        <select name="category" onchange="this.form.submit()">
            <option value="">Semua Kategori</option>
            @foreach($categories as $cat)
                <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
            @endforeach
        </select>
        <label>Urutkan:</label>
        <select name="sort" onchange="this.form.submit()">
            <option value="title_asc"  {{ $sort == 'title_asc'  ? 'selected' : '' }}>Judul A-Z</option>
            <option value="title_desc" {{ $sort == 'title_desc' ? 'selected' : '' }}>Judul Z-A</option>
            <option value="price_low"  {{ $sort == 'price_low'  ? 'selected' : '' }}>Harga Termurah</option>
            <option value="price_high" {{ $sort == 'price_high' ? 'selected' : '' }}>Harga Termahal</option>
        </select>
        @if(request('category'))
            <a href="{{ route('products.index') }}" class="btn btn-outline btn-sm">Reset</a>
        @endif
    </form>

    <div class="book-grid">
        @forelse($books as $book)
        <div class="book-card">
            <a href="{{ route('products.show', $book) }}" style="text-decoration:none;color:inherit;">
                <div class="book-cover">
                    <div class="book-cover-emoji">📖</div>
                    <div class="book-cover-title">{{ $book->title }}</div>
                </div>
            </a>
            <div class="book-info">
                <div class="book-category">{{ $book->category }}</div>
                <div class="book-title">{{ $book->title }}</div>
                <div class="book-author">{{ $book->author }}</div>
                <div class="book-footer">
                    <div class="book-price">{{ $book->price_formatted }}</div>
                    @auth
                    <form method="POST" action="{{ route('cart.add', $book) }}">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-sm">+ Cart</button>
                    </form>
                    @else
                    <a href="{{ route('login') }}" class="btn btn-outline btn-sm">Login</a>
                    @endauth
                </div>
            </div>
        </div>
        @empty
        <div style="grid-column:1/-1;text-align:center;padding:3rem;color:var(--text-light);">
            <p style="font-size:2rem;">📚</p>
            <p>Tidak ada buku ditemukan.</p>
        </div>
        @endforelse
    </div>

    {{ $books->links() }}
</div>
@endsection
