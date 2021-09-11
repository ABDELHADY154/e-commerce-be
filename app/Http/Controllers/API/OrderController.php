<?php

namespace App\Http\Controllers\API;

use AElnemr\RestFullResponse\CoreJsonResponse;
use App\Client;
use App\Http\Controllers\Controller;
use App\Http\Resources\API\OrderResource;
use App\Order;
use App\Product;
use App\ProductSize;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    use CoreJsonResponse;

    public function checkout(Request $request)
    {
        $request->validate([
            'address_id' => ['required', 'exists:client_addresses,id'],
            'price' => ['required'],
            'products' => ['required', 'array']
        ]);
        $client = Client::find(auth('api')->id());

        if ($client) {
            $address = $client->addresses()->where('id', $request->address_id)->first();
            if ($address) {
                $order = Order::create([
                    'order_num' => $client->name[0] . $client->name[1] . $request->address_id . Str::random(5),
                    'client_id' => $client->id,
                    'address_id' => $address->id,
                    'delivery' => 30,
                    'price' => $request->price,
                    'total_price' => $request->price + 30,
                ]);
                foreach ($request->products as $item) {
                    $productSize = ProductSize::find($item["size_id"]);
                    $product = Product::find($item['product_id']);

                    if ($productSize->quantity < $item['quantity']) {
                        // $cart = $client->carts()->first();
                        // if ($cart) {
                        //     $cart->products()->detach($product->id);
                        //     $cart->save();
                        // }
                        return $this->forbidden(['message' => 'product not availble', 'product' => $product]);
                    }
                }
                foreach ($request->products as $item) {
                    $order->products()->attach($order->id, [
                        "product_id" => $item["product_id"],
                        "size_id" => $item["size_id"],
                        "quantity" => $item["quantity"],
                    ]);
                    $productSize = ProductSize::find($item["size_id"]);
                    $productSize->quantity -= $item["quantity"];
                    $productSize->save();
                    $product = Product::find($item['product_id']);
                    $product->quantity -= $item["quantity"];
                    $product->save();
                }
                $cart = $client->carts()->first();
                if ($cart) {
                    $cart->products()->detach();
                    $cart->quantity = 0;
                    $cart->total_price = 0;
                    $cart->save();
                }
                return   $this->created(['order' => $order]);
            }
            return $this->notFound(['address' => 'address not found']);
        }
        return $this->notFound(['client' => 'client not found']);
    }

    public function getOrder($id)
    {
        $client = Client::find(auth('api')->id());

        $order = $client->orders()->find($id);
        if ($order) {
            return $this->ok((new OrderResource($order))->resolve());
        }
    }

    public function getOrderedStatus()
    {
        $client = Client::find(auth('api')->id());

        $orders = $client->orders()->where('status', 'ordered')->get();
        if ($orders) {
            return $this->ok(OrderResource::collection($orders)->resolve());
        }
    }

    public function getProcessStatus()
    {
        $client = Client::find(auth('api')->id());

        $orders = $client->orders()->where('status', 'processing')->orWhere('status', 'on the way')->get();
        if ($orders) {
            return $this->ok(OrderResource::collection($orders)->resolve());
        }
    }

    public function getDeliveredStatus()
    {
        $client = Client::find(auth('api')->id());

        $orders = $client->orders()->where('status', 'delivered')->get();
        if ($orders) {
            return $this->ok(OrderResource::collection($orders)->resolve());
        }
    }
}
