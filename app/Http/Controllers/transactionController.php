<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Cart;
use App\Models\Animal;
use App\Models\Personnel;
use App\Models\Transaction;
use App\Models\Customer;
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
            "animals",
            "animals.customer_id",
            "=",
            "customers.id"
        )
            ->rightjoin(
                "transactions",
                "transactions.animal_id",
                "=",
                "animals.id"
            )
            ->leftjoin(
                "services",
                "services.id",
                "=",
                "transactions.service_id"
            )
            ->leftjoin(
                "personnels",
                "personnels.id",
                "=",
                "transactions.personnel_id"
            )
            ->select(
                "transactions.id",
                "customers.first_name",
                "customers.last_name",
                "animals.animal_name",
                "services.service_name",
                "personnels.full_name",
                "transactions.date",
                "transactions.status",
            )

            ->orderBy("transactions.id", "ASC")
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
        $animals = Animal::join(
            "customers",
            "customers.id",
            "=",
            "animals.customer_id"
        )
            ->join(
                "type",
                "type.id",
                "=",
                "animals.type_id"
            )
            ->select(
                "customers.first_name",
                "animals.id",
                "animals.animal_name",
                "animals.age",
                "animals.gender",
                "type.type",
                "animals.images",
                "animals.customer_id",
                "animals.deleted_at"
            )
            ->get();
        $services = Service::all();
        return view("transaction.data", [
            "services" => $services,
            "animals" => $animals,
        ]);
    }

    public function getCart()
    {
        if (!Session::has("cart")) {
            return view("transaction.shopping-cart");
        }
        $oldService = Session::get("cart");
        $cart = new Cart($oldService);
        return view("transaction.shopping-cart", [
            "services" => $cart->services,
            "animals" => $cart->animals,
            "totalCost" => $cart->totalCost,
        ]);
    }

    public function getAddToCart(Request $request, $id)
    {
        $services = Service::find($id);
        $oldService = Session::has("cart")
            ? $request->session()->get("cart")
            : null;
        $cart = new Cart($oldService);
        $cart->add($services, $services->id);
        $request->session()->put("cart", $cart);
        Session::put("cart", $cart);
        $request->session()->save();
        return redirect()->back();
        // dd(Session::all());
    }

    public function getAnimal(Request $request, $id)
    {
        $animals = Animal::find($id);
        $oldService = Session::has("cart")
            ? $request->session()->get("cart")
            : null;
        $cart = new Cart($oldService);
        $cart->addAnimal($animals, $animals->id);
        $request->session()->put("cart", $cart);
        Session::put("cart", $cart);
        $request->session()->save();
        return redirect()->back();
        // dd(Session::all());
    }

    public function getRemoveItem($id)
    {
        $oldCart = Session::has("cart") ? Session::get("cart") : null;
        $cart = new Cart($oldCart);
        $cart->removeService($id);
        if (count($cart->services) > 0) {
            Session::put("cart", $cart);
        } else {
            Session::forget("cart");
        }
        return redirect()->route("transaction.shoppingCart");
    }

    public function removeService($id)
    {
        $this->totalCost -= $this->services[$id]["cost"];
        unset($this->services[$id]);
        unset($this->animals[$id]);
    }

    public function postCheckout(Request $request)
    {
        if (!Session::has("cart")) {
            return redirect()->route("transaction.index");
        }
        $oldCart = Session::get("cart");
        $cart = new Cart($oldCart);
        try {
            DB::beginTransaction();
            foreach ($cart->services as $services) {
                foreach ($cart->animals as $animals) {
                    $id = $services["services"]["id"];
                    $animal_id = $animals["animals"]["id"];
                    DB::table("transactions")->insert([
                        "personnel_id" => Auth::id(),
                        "service_id" => $id,
                        "animal_id" => $animal_id,
                        "created_at" => now(),
                        "updated_at" => now(),
                        "date" => now(),
                    ]);
                }
            }
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()
                ->route("transaction.shoppingCart")
                ->with("error", $e->getMessage());
        }
        DB::commit();
        Session::forget("cart");
        return redirect()->route("receipt");
    }

    public function getReceipt()
    {
        $customers = Customer::rightJoin(
            "animals",
            "animals.customer_id",
            "=",
            "customers.id"
        )
            ->rightjoin(
                "transactions",
                "transactions.animal_id",
                "=",
                "animals.id"
            )
            ->leftjoin(
                "services",
                "services.id",
                "=",
                "transactions.service_id"
            )
            ->select(
                "customers.first_name",
                "animals.animal_name",
                "services.service_name",
                "services.cost",
                "transactions.id",
                "customers.deleted_at"
            )

            ->orderBy("transactions.id", "DESC")
            // ->where("transactions.id")
            ->latest("transactions.id")
            ->take("6")
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
        $services = DB::table('services')
            ->rightJoin('contacts', 'contacts.service_id', 'services.id')
            ->select('contacts.id', 'contacts.service_id', 'services.service_name', 'contacts.name', 'contacts.email', 'contacts.phone_number', 'contacts.review')
            ->where('services.id', $id)
            ->get();

        return view('transaction.show', ['services' => $services]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $transactions = Transaction::find($id);
        $personnels = Personnel::pluck("full_name", "id");
        $animals = Animal::pluck("animal_name", "id");
        $services = Service::pluck("service_name", "id");
        return view("transaction.edit", [
            "transactions" => $transactions,
            "personnels" => $personnels,
            "animals" => $animals,
            "services" => $services,
        ]);
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
        $transactions = Transaction::find($id);
        $transactions->date = $request->input("date");
        $transactions->status = $request->input("status");
        $transactions->personnel_id = $request->input("personnel_id");
        $transactions->animal_id = $request->input("animal_id");
        $transactions->service_id = $request->input("service_id");
        $transactions->update();
        return Redirect::to("transaction")->withSuccessMessage(
            "Transaction Data Updated!"
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function Delete($id)
    {
        $transactions = Transaction::findOrFail($id);
        $transactions->forceDelete();
        return Redirect::route("transaction.index")->withSuccessMessage(
            "Transaction Data Deleted!"
        );
    }
}
