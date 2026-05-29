@extends('layouts.app')
@section('title', 'Checkout')
@section('content')
<div class="page-header">
    <div class="container">
        <h1>💳 Checkout</h1>
        <p>Isi data pengiriman dan pembayaran</p>
    </div>
</div>
<div class="container" style="padding-bottom:3rem;">
    <div style="display:grid;grid-template-columns:1fr 340px;gap:1.5rem;align-items:start;">
        <div class="card" style="padding:2rem;">
            <h3 style="font-family:'Playfair Display',serif;font-size:1.3rem;margin-bottom:1.5rem;">Data Pengiriman</h3>
            <form method="POST" action="{{ route('checkout.store') }}">
                @csrf
                <div class="form-group">
                    <label>Nama Lengkap *</label>
                    <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}"
                        class="{{ $errors->has('name') ? 'invalid' : '' }}"
                        placeholder="Nama penerima" maxlength="50">
                    @error('name')<div class="form-error">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label>Alamat Lengkap *</label>
                    <input type="text" name="address" value="{{ old('address') }}"
                        class="{{ $errors->has('address') ? 'invalid' : '' }}"
                        placeholder="Jl. Contoh No. 123, Kota" maxlength="200">
                    @error('address')<div class="form-error">{{ $message }}</div>@enderror
                </div>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;">
                    <div class="form-group">
                        <label>Nomor HP *</label>
                        <input type="text" name="phone" value="{{ old('phone') }}"
                            class="{{ $errors->has('phone') ? 'invalid' : '' }}"
                            placeholder="08xxxxxxxxxx" maxlength="15">
                        @error('phone')<div class="form-error">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label>Kode Pos *</label>
                        <input type="text" name="zip" value="{{ old('zip') }}"
                            class="{{ $errors->has('zip') ? 'invalid' : '' }}"
                            placeholder="12345" maxlength="10">
                        @error('zip')<div class="form-error">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="form-group">
                    <label>Metode Pembayaran *</label>
                    <select name="payment" class="{{ $errors->has('payment') ? 'invalid' : '' }}">
                        <option value="">-- Pilih Metode --</option>
                        <option value="transfer" {{ old('payment')=='transfer'?'selected':'' }}>Transfer Bank</option>
                        <option value="cod"      {{ old('payment')=='cod'?'selected':'' }}>COD (Bayar di Tempat)</option>
                        <option value="ewallet"  {{ old('payment')=='ewallet'?'selected':'' }}>E-Wallet</option>
                    </select>
                    @error('payment')<div class="form-error">{{ $message }}</div>@enderror
                </div>
                <button type="submit" class="btn btn-primary" style="width:100%;padding:0.9rem;font-size:1rem;">
                    ✅ Konfirmasi Pesanan
                </button>
            </form>
        </div>

        <div class="card" style="padding:1.5rem;position:sticky;top:80px;">
            <h3 style="font-family:'Playfair Display',serif;margin-bottom:1rem;padding-bottom:0.8rem;border-bottom:1px solid var(--border);">Pesananmu</h3>
            @foreach($items as $item)
            <div style="display:flex;gap:0.8rem;margin-bottom:1rem;padding-bottom:1rem;border-bottom:1px solid var(--border);">
                <div style="background:var(--brown);width:40px;height:50px;border-radius:4px;display:flex;align-items:center;justify-content:center;flex-shrink:0;font-size:1.2rem;">📖</div>
                <div style="flex:1;">
                    <div style="font-size:0.85rem;font-weight:600;">{{ $item->book->title }}</div>
                    <div style="font-size:0.8rem;color:var(--text-light);">x{{ $item->quantity }}</div>
                    <div style="font-size:0.85rem;font-weight:700;color:var(--brown);">Rp {{ number_format($item->book->price * $item->quantity, 0, ',', '.') }}</div>
                </div>
            </div>
            @endforeach
            <div style="display:flex;justify-content:space-between;font-weight:700;font-size:1.1rem;">
                <span>Total</span>
                <span style="color:var(--brown);">Rp {{ number_format($total, 0, ',', '.') }}</span>
            </div>
        </div>
    </div>
</div>
@endsection
