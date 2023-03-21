<?php
namespace App\Http\Controllers;

use App\Http\Resources\Cart\CartResource;
use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        // $cart = Cart::get();
        // return CartResource::collection($cart);
        dd(session()->all());
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
        } else {
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

}
