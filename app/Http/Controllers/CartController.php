<?php
namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Order\OrderRequest;
use App\Http\Resources\Cart\CartResource;

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
        if ($id) {
            Cart::remove($id);
        }
        else {
            Cart::destroy($id);
        }
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'id' => '',
            'quantity' => ''
        ]);
        Cart::quantity($data['id'], $data['quantity']);
    }

    public function order(OrderRequest $request)
    {
        $data = $request->validated();
        $cart = Cart::get();
        dd($cart);
        $user = $request->user();
        if (Auth::check()) {
            $order = Order::create([
                'name' => $user->name,
                'email' => $user->email,
                'phone_number' => $user->phone_number,
                'cart_id' => $cart->id,
            ]);
        } else {
            $order = Order::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone_number' => $data['phone_number'],
                'cart_id' => $cart->id,
            ]);
        }
        return response()->json($order);
    }
}
