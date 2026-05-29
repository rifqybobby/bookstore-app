<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $items = CartItem::with('book')->where('user_id', Auth::id())->get();

        if ($items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Cart kamu masih kosong!');
        }

        $total = $items->sum(fn($i) => $i->book->price * $i->quantity);
        return view('checkout.index', compact('items', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|min:1|max:50',
            'address' => 'required|string|min:5|max:200',
            'phone'   => 'required|string|min:10|max:15',
            'zip'     => 'required|digits_between:1,10',
            'payment' => 'required|in:transfer,cod,ewallet',
        ]);

        $items = CartItem::with('book')->where('user_id', Auth::id())->get();

        if ($items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Cart kamu masih kosong!');
        }

        $total = $items->sum(fn($i) => $i->book->price * $i->quantity);

        DB::transaction(function () use ($request, $items, $total) {
            $order = Order::create([
                'user_id' => Auth::id(),
                'name'    => $request->name,
                'address' => $request->address,
                'phone'   => $request->phone,
                'zip'     => $request->zip,
                'payment' => $request->payment,
                'total'   => $total,
                'status'  => 'pending',
            ]);

            foreach ($items as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'book_id'  => $item->book_id,
                    'quantity' => $item->quantity,
                    'price'    => $item->book->price,
                ]);
            }

            CartItem::where('user_id', Auth::id())->delete();
        });

        return redirect()->route('checkout.success')->with('success', 'Pesanan berhasil dibuat!');
    }

    public function success()
    {
        return view('checkout.success');
    }
}
