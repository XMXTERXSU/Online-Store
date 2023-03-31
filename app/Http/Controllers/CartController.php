<?php
namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Order\OrderRequest;
use App\Http\Resources\Cart\CartResource;
use App\Http\Requests\Cart\QuantityRequest;
use App\Http\Resources\Order\OrderResource;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::get();
        return CartResource::collection($cart);
    }

    public function add($product_id)
    {
        $cart = Cart::add($product_id);

        return response()->json($cart);
    }

    public function remove($id = null)
    {
        $cart = Cart::where(['session_id' => session()->getId(), 'product_id' => $id])->first();
        if ($id) {
            $cart->remove($id);
        } else {
            $cart->destroy($id);
        }
        return redirect()->route('cart');
    }

    public function update($id)
    {
        $cart = Cart::where(['session_id' => session()->getId(), 'product_id' => $id])->first();
        $data = request()->validate([
            'quantity' => 'integer'
        ]);
        $cart->quantity($id, $data['quantity']);
        return redirect()->route('cart');
    }

    public function order(OrderRequest $request)
    {
        $data = $request->validated();
        $user = $request->user();
        if (Auth::check()) {
            $order = Order::create([
                'name' => $user->name,
                'email' => $user->email,
                'phone_number' => $user->phone_number,
                'session_id' => session()->getId(),
                'user_id' => $user()->id
            ]);
        } else {
            $order = Order::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone_number' => $data['phone_number'],
                'session_id' => session()->getId(),
            ]);
        }
        return response()->json($order);
    }

    public function orderList()
    {
        $order = Order::get();

        return OrderResource::collection($order);
    }
}
