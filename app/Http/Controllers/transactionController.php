<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Cart;
use App\Models\Pets;
use App\Models\Hoomans;
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
            "pets",
            "pets.customer_id",
            "=",
            "customers.id"
        )
            ->leftjoin(
                "hoomans",
                "hoomans.id",
                "=",
                "transacs.hoomans_id"
            )
            ->rightjoin(
                "transacs",
                "transacs.pets_id",
                "=",
                "pets.id"
            )
            ->leftjoin(
                "services",
                "services.id",
                "=",
                "transacs.service_id"
            )

            ->select(
                "transacs.id",
                "customers.full_name",
                "pets.pets_name",
                "services.service_name",
                "hoomans.full_name",
                "transacs.date",
                "transacs.status",
            )

            ->orderBy("transacs.id", "ASC")
            ->withTrashed()
            ->paginate(6);
        return view("transaction.index", [
            "customers" => $customers,
        ]);
    }

    public function getDetail()
    {
        $pets = Pets::join(
            "customers",
            "customers.id",
            "=",
            "pets.customer_id"
        )
            ->join(
                "classify",
                "classify.id",
                "=",
                "pets.classify_id"
            )
            ->select(
                "customers.name",
                "pets.id",
                "pets.pets_name",
                "pets.gender",
                "classify.classify",
                "pets.images",
                "pets.customer_id",
                "pets.deleted_at"
            )
            ->get();
        $services = Service::all();
        return view("transaction.detail", [
            "services" => $services,
            "pets" => $pets,
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
            "pets" => $cart->pets,
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
        return redirect()->route("detail");
    }

    public function getPet(Request $request, $id)
    {
        $pets =  pets::find($id);
        $oldService = Session::has("cart")
            ? $request->session()->get("cart")
            : null;
        $cart = new Cart($oldService);
        $cart->addPet($pets, $pets->id);
        $request->session()->put("cart", $cart);
        Session::put("cart", $cart);
        $request->session()->save();
        return redirect()->route("detail");
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
    }

    public function removeService($id)
    {
        $this->totalCost -= $this->services[$id]["cost"];
        unset($this->services[$id]);
        unset($this->pets[$id]);
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
                foreach ($cart->pets as $pets) {
                    $id = $services["services"]["id"];
                    $pets_id = $pets["pets"]["id"];
                    DB::table("transacs")->insert([
                        "hooman_id" => Auth::id(),
                        "service_id" => $id,
                        "pets_id" => $pets_id,
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
        return redirect()->route("resibo");
    }

    public function getResibo()
    {
        $customers = Customer::rightJoin(
            "pets",
            "pets.customer_id",
            "=",
            "customers.id"
        )

            ->rightjoin(
                "transacs",
                "transacs.pets_id",
                "=",
                "pets.id"
            )
            ->rightjoin(
                "services",
                "services.id",
                "=",
                "transacs.service_id"
            )

            ->select(
                "customers.name",
                "pets.pets_name",
                "services.service_name",
                "services.cost",
                "transacs.id",
                "transacs.service_id",
            )

            ->orderBy("transacs.id", "DESC")
            // ->where("transacs.id")
            ->latest("transacs.id")
            ->take("6")
            ->get();
        return view("transaction.resibo", [
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
            ->rightJoin('comments', 'comments.service_id', 'services.id')
            ->select('comments.id', 'comments.service_id', 'services.service_name', 'comments.name', 'comments.email', 'comments.feedback')
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
        $hoomans = Hoomans::pluck("full_name", "id");
        $pets = Pets::pluck("pets_name", "id");
        $services = Service::pluck("service_name", "id");
        return view("transaction.edit", [
            "transactions" => $transactions,
            "hoomans" => $hoomans,
            "pets" => $pets,
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
        $transactions->hooman_id = $request->input("hooman_id");
        $transactions->pets_id = $request->input("pets_id");
        $transactions->service_id = $request->input("service_id");
        $transactions->update();
        return Redirect::to("transaction");
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
        return Redirect::route("transaction.index");
    }
}
