<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\customerRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
use App\Models\Customer;

class customerController extends Controller
{

    public function search()
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
            )
            ->orderBy("customers.id", "ASC")
            ->get();
        return view("customers.search", [
            "customers" => $customers,
        ]);
    }

    public function result()
    {
        $result = $_GET["result"];
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
                "customers.deleted_at"
            )

            ->where("customers.name", "LIKE", "%" . $result . "%")
            ->get();
        return view("customers.result", [
            "customers" => $customers,
        ]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Customers = Customer::leftJoin(
            "pets",
            "customers.id",
            "=",
            "pets.customer_id"
        )
            ->select(
                "customers.id",
                "customers.name",
                "customers.contactNum",
                "customers.pics",
                "customers.deleted_at",
                "pets.pets_name"
            )
            ->orderBy("customers.id", "ASC")
            ->withTrashed()
            ->paginate(3);

        return view("customers.index", ["customers" => $Customers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make("customers.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(customerRequest $request)
    {
        $Customers = new Customer();
        $Customers->name = $request->input("name");

        $Customers->contactNum = $request->input("contactNum");
        if ($request->hasfile("pics")) {
            $file = $request->file("pics");
            $filename = uniqid() . "_" . $file->getClientOriginalName();
            $file->move("imagefolder/customers/", $filename);
            $Customers->pics = $filename;
        }
        $Customers->save();
        return Redirect::to("customer");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customers = Customer::leftJoin(
            "pets",
            "customers.id",
            "=",
            "pets.customer_id"
        )
            ->select(
                "customers.id",
                "customers.name",
                "customers.contactNum",
                "customers.pics",
                "customers.deleted_at",
                "pets.pets_name"
            )
            ->where('customers.id', $id)
            ->get();

        return View::make('customers.show', compact('customers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Customers = Customer::find($id);
        return View::make("customers.edit", compact("Customers"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(customerRequest $request, $id)
    {
        $Customers = Customer::find($id);
        $Customers->name = $request->input("name");
        if ($request->hasfile("pics")) {
            $destination = "imagefolder/customers/" . $Customers->pics;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file("pics");
            $filename = uniqid() . "_" . $file->getClientOriginalName();
            $file->move("imagefolder/customers/", $filename);
            $Customers->pics = $filename;
        }
        $Customers->update();
        return Redirect::to("customer");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Customer::destroy($id);
        return Redirect::to("customer");
    }

    public function restore($id)
    {
        Customer::onlyTrashed()
            ->findOrFail($id)
            ->restore();
        return Redirect::route("customer.index");
    }

    public function forceDelete($id)
    {
        $Customers = Customer::findOrFail($id);
        $destination = "imagefolder/customers/" . $Customers->pics;
        if (File::exists($destination)) {
            File::delete($destination);
        }
        $Customers->forceDelete();
        return Redirect::route("customer.index");
    }
}
