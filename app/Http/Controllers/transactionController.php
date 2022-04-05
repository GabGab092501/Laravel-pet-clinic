<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class transactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::all();
        // dd($items);
        return view('transaction.index', compact('services'));
    }

    public function getCart()
    {
        if (!Session::has('cart')) {
            return view('transaction.shopping-cart');
        }
        $oldService = Session::get('cart');
        $cart = new Cart($oldService);
        return view('transaction.shopping-cart', ['services' => $cart->services, 'totalCost' => $cart->totalCost]);
    }

    public function getAddToCart(Request $request, $id)
    {
        $services = Service::find($id);
        $oldService = Session::has('cart') ? $request->session()->get('cart') : null;
        $cart = new Cart($oldService);
        $cart->add($services, $services->id);
        $request->session()->put('cart', $cart);
        Session::put('cart', $cart);
        $request->session()->save();
        dd(Session::all());
    }

    public function getRemoveItem($id)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeService($id);
        if (count($cart->services) > 0) {
            Session::put('cart', $cart);
        } else {
            Session::forget('cart');
        }
        return redirect()->route('transaction.shoppingCart');
    }

    public function removeService($id)
    {
        $this->totalCost -= $this->services[$id]['cost'];
        unset($this->services[$id]);
    }

    // public function postCheckout(Request $request)
    // {
    //     if (!Session::has('cart')) {
    //         return redirect()->route('item.index');
    //     }
    //     $oldCart = Session::get('cart');
    //     $cart = new Cart($oldCart);
    //     //dd($cart);
    //     try {
    //         DB::beginTransaction();
    //         $order = new Order();
    //         //dd($order);
    //         $customer =  Customer::where('user_id', Auth::id())->first();
    //         //dd($customer);
    //         $order->customer_id = $customer->customer_id;
    //         $order->date_placed = now();
    //         $order->date_shipped = Carbon::now()->addDays(5);
    //         $order->shipvia = $request->shipper_id;
    //         $order->shipping = $request->shipping;
    //         $order->status = 'Processing';
    //         $order->save();
    //         //dd($order);
    //         foreach ($cart->items as $items) {
    //             $id = $items['item']['item_id'];
    //             //dd($id);
    //             DB::table('orderline')->insert(
    //                 [
    //                     'item_id' => $id,
    //                     'orderinfo_id' => $order->orderinfo_id,
    //                     'quantity' => $items['qty']
    //                 ]
    //             );
    //             //dd($items);
    //             $stock = Stock::find($id);
    //             //$stock = DB::table('stock')->where('item_id', $id)->first();
    //             //dd($stock);
    //             $stock->quantity = $stock->quantity - $items['qty'];
    //             $stock->save();
    //         }
    //         // dd($order);
    //     } catch (\Exception $e) {
    //         // dd($e);
    //         DB::rollback();
    //         // dd($order);
    //         return redirect()->route('item.shoppingCart')->with('error', $e->getMessage());
    //     }
    //     DB::commit();
    //     Session::forget('cart');
    //     return redirect()->route('item.index')->with('success', 'Successfully Purchased Your Items!!!');
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
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
}
