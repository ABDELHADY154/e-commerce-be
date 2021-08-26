<?php

namespace App\Http\Controllers\API;

use AElnemr\RestFullResponse\CoreJsonResponse;
use App\Cart;
use App\Client;
use App\Http\Controllers\Controller;
use App\Http\Resources\API\CartResource;
use App\Product;
use App\ProductSize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{

    use CoreJsonResponse;

    public function addToCart(Request $request)
    {
        $request->validate([
            'size_id' => ['required', 'exists:product_sizes,id'],
            'product_id' => ['required', 'exists:products,id'],
        ]);
        if ($productSize = ProductSize::where('id', $request->size_id)->first()) {
            $quantity = $productSize->quantity;
        }
        $request->validate([
            'quantity' => ['required', 'integer', 'min:1', "max:${quantity}"],
        ]);
        $product = Product::find($request->product_id);
        $client = Client::find(auth('api')->id());

        if (!$client->carts->first()) {
            $client->carts()->create([
                'quantity' => 0,
                'total_price' => 0,
                'client_id' => $client->id
            ]);
        }

        $cart = Cart::where('client_id', $client->id)->first();

        foreach ($cart->products as $item) {
            if ($item->pivot->product_id == $request->product_id && $item->pivot->cart_id == $cart->id) {

                if ($item->pivot->size_id == $request->size_id) {
                    $cart->quantity = ($cart->quantity - $item->pivot->quantity) + $request->quantity;
                    $cart->total_price = ($cart->total_price - ($item->pivot->quantity * $product->total_price)) + ($request->quantity * $product->total_price);
                    $cart->save();
                    $cart->products()->updateExistingPivot($request->product_id, [
                        'quantity' => $request->quantity,
                        'size_id' => $request->size_id,
                        'product_id' => $request->product_id,
                    ]);
                    return $this->ok(['added']);
                }

                $cart->quantity += $request->quantity;
                $cart->total_price += ($request->quantity * $product->total_price);
                $cart->save();
                $cart->products()->attach($request->product_id, [
                    'quantity' => $request->quantity,
                    'size_id' => $request->size_id,
                    'product_id' => $request->product_id,
                ]);
                return $this->ok(['added']);
            }
        }

        $cart->products()->attach($cart->id, [
            'quantity' => $request->quantity,
            'size_id' => $request->size_id,
            'product_id' => $request->product_id,
        ]);

        $cart->quantity += $request->quantity;
        $cart->total_price += ($request->quantity * $product->total_price);
        $cart->save();
        return $this->ok(['added']);
    }

    public function cartList()
    {
        $client = Client::find(auth('api')->id());
        $cart = Cart::where('client_id', $client->id)->first();
        if ($cart) {
            return $this->ok((new CartResource($cart))->resolve());
        }
        return $this->notFound(['cart not found']);
    }

    public function updateCart(Request $request)
    {
        $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'quantity' => ['required', 'integer', 'min:1',],
        ]);
        $client = Client::find(auth('api')->id());
        $product = Product::find($request->product_id);

        if (!$client->carts->first()) {
            $client->carts()->create([
                'quantity' => 0,
                'total_price' => 0,
                'client_id' => $client->id
            ]);
        }

        $cart = Cart::where('client_id', $client->id)->first();
        foreach ($cart->products as $item) {
            if ($item->pivot->product_id == $request->product_id && $item->pivot->cart_id == $cart->id) {
                $cart->quantity = ($cart->quantity - $item->pivot->quantity) + $request->quantity;
                $cart->total_price = ($cart->total_price - ($item->pivot->quantity * $product->total_price)) + ($request->quantity * $product->total_price);
                $cart->save();
                $cart->products()->updateExistingPivot($request->product_id, [
                    'quantity' => $request->quantity,
                ]);
                return $this->ok(['updated']);
            }
        }
    }

    public function deleteCartItem(Request $request)
    {
        $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'size_id' => ['required', 'exists:product_sizes,id'],
        ]);
        $client = Client::find(auth('api')->id());
        $product = Product::find($request->product_id);
        $cart = Cart::where('client_id', $client->id)->first();
        if ($cart) {
            $cartProduct = DB::table('cart_product')->where('product_id', $product->id)->where('size_id', $request->size_id)->first();
            if ($cartProduct) {
                $cart->quantity -= $cartProduct->quantity;
                $cart->total_price -= ($cartProduct->quantity * $product->total_price);
                $cart->save();
                $cartProduct = DB::table('cart_product')->where('product_id', $product->id)->where('size_id', $request->size_id)->delete();
                return $this->ok(['deleted']);
            }
            return $this->notFound(['item not found']);
        }
        return $this->notFound(['cart not found']);
    }
}
