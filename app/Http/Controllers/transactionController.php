<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Cart;
use App\Models\Pets;
use App\Models\Personnel;
use App\Models\Transaction;
use App\Models\Customer;
use App\Models\Transaction_line;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use RealRashid\SweetAlert\Facades\Alert;

class transactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::rightJoin(
            "pets",
            "pets.customer_id",
            "=",
            "customers.id"
        )
            ->rightjoin(
                "transaction_line",
                "transaction_line.pets_id",
                "=",
                "pets.id"
            )
            ->leftjoin(
                "services",
                "services.id",
                "=",
                "transaction_line.service_id"
            )
            ->leftjoin(
                "transactions",
                "transactions.id",
                "=",
                "transaction_line.transaction_id"
            )
            ->leftjoin(
                "hoomans",
                "hoomans.id",
                "=",
                "transactions.personnel_id"
            )
            ->select(
                "transactions.id",
                "pets.pets_name",
                "services.service_name",
                "hoomans.name",
                "transactions.date",
                "transactions.deleted_at",
                "transaction_line.deleted_at",
            )

            ->orderBy("transaction_line.transaction_id", "ASC")
            ->withTrashed()
            ->paginate(6);
        if (session(key: "success_message")) {
            Alert::image(
                "Congratulations!",
                session(key: "success_message"),
                "https://media1.giphy.com/media/RlI8KU5ZPym0f1bZoF/giphy.gif?cid=6c09b952413438a6eef5934ef4253170b611937fa7566f75&rid=giphy.gif&ct=s",
                "200",
                "200",
                "I Am A Pic"
            );
        }
        return view("transaction.index", [
            "customers" => $customers,
        ]);
    }

    public function getData()
    {
        $pets = pets::all();
        $services = Service::all();
        return view('transaction.data', [
            'services' => $services,
            'pets' => $pets,
        ]);
    }

    public function getCart()
    {
        if (!Session::has('cart')) {
            return view('transaction.shopping-cart');
        }
        $oldService = Session::get('cart');
        $cart = new Cart($oldService);
        return view('transaction.shopping-cart', ['services' => $cart->services, 'pets' => $cart->pets, 'totalCost' => $cart->totalCost]);
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

    public function getpets(Request $request, $id)
    {
        $pets = pets::find($id);
        $oldService = Session::has('cart') ? $request->session()->get('cart') : null;
        $cart = new Cart($oldService);
        $cart->addpets($pets, $pets->id);
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
            $hoomans =  Personnel::where('id', Auth::id())->first();
            $transactions->personnel_id = $hoomans->id;
            $transactions->date = now();
            $transactions->save();

            foreach ($cart->services as $services) {
                foreach ($cart->pets as $pets) {
                    $id = $services['services']['id'];
                    $pets_id = $pets['pets']['id'];
                    DB::table('transaction_line')->insert(
                        [
                            'service_id' => $id,
                            'pets_id' => $pets_id,
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
        return redirect()->route('receipt');
    }

    public function getReceipt()
    {
        $customers = Customer::rightJoin(
            "pets",
            "pets.customer_id",
            "=",
            "customers.id"
        )
            ->rightjoin(
                "transaction_line",
                "transaction_line.pets_id",
                "=",
                "pets.id"
            )
            ->leftjoin(
                "services",
                "services.id",
                "=",
                "transaction_line.service_id"
            )
            ->leftjoin(
                "transactions",
                "transactions.id",
                "=",
                "transaction_line.transaction_id"
            )
            ->select(
                "customers.first_name",
                "pets.pets_name",
                "services.service_name",
                "services.cost",
                "transactions.id",
                "customers.deleted_at"
            )

            ->orderBy("transactions.id", "DESC")
            ->latest('transactions.id')
            ->take('6')
            ->get();
        return view("transaction.receipt", [
            "customers" => $customers,
        ]);
    }

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
        // $transactions = Transaction::find($id);
        // $transaction_line = Transaction_line::find($id);
        // $hoomans = Personnel::pluck("name", "id");
        // $pets = pets::pluck("pets_name", "id");
        // $services = Service::pluck("service_name", "id");
        // return view("transaction.edit", [
        //     "transactions" => $transactions,
        //     "transaction_line" => $transaction_line,
        //     "hoomans" => $hoomans,
        //     "pets" => $pets,
        //     "services" => $services,
        // ]);
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
        // $transactions = Transaction::find($id);
        // $transactions->date = $request->input("date");
        // $transactions->personnel_id = $request->input("personnel_id");
        // $transactions->update();

        // $transaction_line = Transaction_line::find($id);
        // $transaction_line->pets_id = $request->input("pets_id");
        // $transaction_line->service_id = $request->input("service_id");
        // $transaction_line->update();
        // return Redirect::to("/transaction")->withSuccessMessage(
        //     "Transaction Data Updated!"
        // );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $post = Transaction::findOrFail($id);
        // $postGroups = Transaction::where('id', $post->id)->get();
        // DB::table('transaction_line')->whereIn('transaction_id', $postGroups->pluck('id'))->delete();
        // Transaction::where('transaction_id', $post->id)->delete();

        // return Redirect::to("/transaction")->withSuccessMessage(
        //     "Transaction Data Deleted!"
        // );
    }
}
