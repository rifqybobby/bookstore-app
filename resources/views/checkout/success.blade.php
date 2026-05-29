@extends('layouts.app')
@section('title', 'Pesanan Berhasil')
@section('content')
<div class="container" style="padding:4rem 2rem;text-align:center;">
    <div class="card" style="max-width:500px;margin:0 auto;padding:3rem;">
        <div style="font-size:4rem;margin-bottom:1rem;">🎉</div>
        <h1 style="font-family:'Playfair Display',serif;color:var(--green);margin-bottom:0.8rem;">Pesanan Berhasil!</h1>
        <p style="color:var(--text-light);margin-bottom:2rem;">Terima kasih telah berbelanja di Bukuku. Pesananmu sedang diproses.</p>
        <a href="{{ route('products.index') }}" class="btn btn-primary" style="margin-right:0.5rem;">Belanja Lagi</a>
    </div>
</div>
@endsection
