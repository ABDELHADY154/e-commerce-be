<?php

namespace App\Http\Controllers\API;

use AElnemr\RestFullResponse\CoreJsonResponse;
use App\Client;
use App\Http\Controllers\Controller;
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
                return   $this->created(['order' => $order]);
            }
            return $this->notFound(['address' => 'address not found']);
        }
        return $this->notFound(['client' => 'client not found']);
    }
}
