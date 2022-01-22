<?php

namespace App\Http\Controllers;

use AElnemr\RestFullResponse\CoreJsonResponse;
use App\Cart;
use App\Client;
use Gabievi\Promocodes\Facades\Promocodes;
use Gabievi\Promocodes\Models\Promocode;
use Gabievi\Promocodes\Promocodes as PromocodesPromocodes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PromoCodeController extends Controller
{
    use CoreJsonResponse;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $promocodes = Promocodes::all();
        return view('admin.PromoCode.index', ['promocodes' => $promocodes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.PromoCode.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'reward' => ['required'],
            'days' => ['required'],
            'usage_no' => ['required'],
        ]);

        if ($request->is_disposable) {
            Promocodes::createDisposable($amount = 1, $reward = $request->reward,  $data = [], $expires_in = $request->days, $quantity = $request->usage_no);
        } else {
            Promocodes::create($amount = 1, $reward = $request->reward,  $data = [], $expires_in = $request->days, $quantity = $request->usage_no, $is_disposable = false);
        }

        return redirect(route('promocode.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $promocode = Promocode::find($id);
        return view('admin.PromoCode.edit', ['promocode' => $promocode]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'code' => ['required', `unique:promocodes,code,except,{$id}`],
            'reward' => ['required'],
            'usage_no' => ['required'],
        ]);

        $promoCode = Promocode::find($id);

        $promoCode->update([
            'code' => $request->code,
            'reward' => $request->reward,
            'quantity' => $request->usage_no,
            'is_disposable' => $request->is_disposable ? true : false
        ]);
        $promoCode->save();

        return redirect(route('promocode.index'));
    }
    public function disable($code)
    {


        Promocodes::disable($code);
        return redirect(route('promocode.index'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function check(Request $request)
    {
        $request->validate([
            'promo' => ['required', 'string'],
        ]);
        $promo = Promocodes::check($request->promo);
        $client = Client::find(auth('api')->id());
        $cart = Cart::where('client_id', $client->id)->first();
        if ($promo) {
            $perc = $promo->reward / 100;
            $total_price = $cart->total_price - ($cart->total_price * $perc);
            $userCodes = DB::table('promocode_user')->get();

            foreach ($userCodes as $clientPromo) {
                if ($clientPromo->user_id == $client->id && $clientPromo->promocode_id == $promo->id) {
                    return $this->forbidden(['promo code is used before !']);
                }
            }


            return $this->ok(['cart' => $cart, 'price' => $total_price, 'discount' => $promo->reward . "%"]);
        }
        return $this->notFound();
    }
    public function usePromo(Request $request)
    {
        $request->validate([
            'promo' => ['required', 'string'],
        ]);
        $promo = Promocodes::check($request->promo);
        $client = Client::find(auth('api')->id());
        $cart = Cart::where('client_id', $client->id)->first();
        if ($promo) {
            $perc = $promo->reward / 100;
            $total_price = $cart->total_price - ($cart->total_price * $perc);
            $userCodes = DB::table('promocode_user')->get();

            foreach ($userCodes as $clientPromo) {
                if ($clientPromo->user_id == $client->id && $clientPromo->promocode_id == $promo->id) {
                    return $this->forbidden(['promo code is used before !']);
                }
            }
            // $client->redeemCode($request->promo, $callback = null);

            DB::table('promocode_user')->insert(
                [
                    'user_id' => $client->id,
                    'promocode_id' => $promo->id,
                ]
            );

            $cart->update([
                'total_price' => $cart->total_price - ($cart->total_price * $perc)
            ]);

            $cart->save();

            return $this->ok(['cart' => $cart, 'price' => $total_price, 'discount' => $promo->reward . "%"]);
        }
        return $this->notFound();
    }
}
