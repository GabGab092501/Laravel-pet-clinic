<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Cart;
use App\Models\Animal;
use App\Models\Personnel;
use App\Models\Transaction;
use App\Models\Transaction_line;
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
        $animals = Animal::all();
        $services = Service::all();
        return view('transaction.index', [
            'services' => $services,
            'animals' => $animals,
        ]);
    }

    public function getCart()
    {
        if (!Session::has('cart')) {
            return view('transaction.shopping-cart');
        }
        $oldService = Session::get('cart');
        $cart = new Cart($oldService);
        return view('transaction.shopping-cart', ['services' => $cart->services, 'animals' => $cart->animals, 'totalCost' => $cart->totalCost]);
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

    public function getAnimal(Request $request, $id)
    {
        $animals = Animal::find($id);
        $oldService = Session::has('cart') ? $request->session()->get('cart') : null;
        $cart = new Cart($oldService);
        $cart->addAnimal($animals, $animals->id);
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

    public function postCheckout(Request $request)
    {
        if (!Session::has('cart')) {
            return redirect()->route('transaction.index');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        try {
            DB::beginTransaction();
            $transactions = new Transaction();
            $personnels =  Personnel::where('id', Auth::id())->first();
            $transactions->personnel_id = $personnels->id;
            $transactions->date = now();
            $transactions->save();

            foreach ($cart->services as $services) {
                foreach ($cart->animals as $animals) {
                    $id = $services['services']['id'];
                    $animal_id = $animals['animals']['id'];
                    DB::table('transaction_line')->insert(
                        [
                            'service_id' => $id,
                            'animal_id' => $animal_id,
                            'transaction_id' => $transactions->id,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]
                    );
                }
            }
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('transaction.shoppingCart')->with('error', $e->getMessage());
        }
        DB::commit();
        Session::forget('cart');
        return redirect()->route('transaction.index')->with('error', 'Congratulations You Have Successfully Checkout!');
    }

    public function getReceipt($id)
    {
        $transactions = Transaction_line::find($id);
        $animals = Animal::pluck("animal_name", "id");
        $services = Service::pluck("cost", "id");
        $services2 = Service::pluck("service_name", "id");
        return view("transaction.receipt", [
            "transaction_line" => $transactions,
            "services" => $services,
            "services" => $services2,
            "animals" => $animals,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $personnels = Personnel::pluck("full_name", "id");
        // $animals = Animal::pluck("animal_name", "id");
        // return view("transaction.create", [
        //     "personnels" => $personnels,
        //     "animals" => $animals,
        // ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // if (!Session::has('cart')) {
        //     return redirect()->route('transaction.index');
        // }
        // $oldCart = Session::get('cart');
        // $cart = new Cart($oldCart);
        // try {
        //     DB::beginTransaction();
        //     $transactions = new Transaction();
        //     $personnels =  Personnel::where('id', Auth::id())->first();
        //     $transactions->personnel_id = $personnels->id;
        //     $transactions->date = now();
        //     $transactions->save();

        //     foreach ($cart->services as $services) {
        //         $id = $services['services']['id'];

        //         DB::table('transaction_line')->insert(
        //             [
        //                 'id' => $id,
        //                 'transaction_id' => $transactions->id,
        //             ]
        //         );
        //     }
        // } catch (\Exception $e) {
        //     DB::rollback();
        //     return redirect()->route('transaction.shoppingCart')->with('error', $e->getMessage());
        // }
        // DB::commit();
        // Session::forget('cart');
        // return redirect()->route('transaction.index')->with('success', 'Successfully Purchased Your Items!!!');
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
