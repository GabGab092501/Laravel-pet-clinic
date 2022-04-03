<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\customerRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
use App\Models\Customer;
use RealRashid\SweetAlert\Facades\Alert;

class customerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Customers = Customer::leftJoin(
            "animals",
            "customers.id",
            "=",
            "animals.customer_id"
        )
            ->select(
                "Customers.id",
                "Customers.first_name",
                "Customers.last_name",
                "Customers.phone_number",
                "Customers.images",
                "Customers.deleted_at",
                "animals.animal_name"
            )
            ->orderBy("Customers.id", "ASC")
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

        return view("customers.index", ["customers" => $Customers]);
        //return view("Customers.index", compact("Customers"));
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
        $Customers->first_name = $request->input("first_name");
        $Customers->last_name = $request->input("last_name");
        $Customers->phone_number = $request->input("phone_number");
        if ($request->hasfile("images")) {
            $file = $request->file("images");
            $filename = uniqid() . "_" . $file->getClientOriginalName();
            $file->move("uploads/customers/", $filename);
            $Customers->images = $filename;
        }
        $Customers->save();
        return Redirect::to("customer")->withSuccessMessage(
            "New Customer Added!"
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Customers = Customer::find($id);
        return View::make("customers.show", compact("Customers"));
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
        $Customers->first_name = $request->input("first_name");
        $Customers->last_name = $request->input("last_name");
        $Customers->phone_number = $request->input("phone_number");
        if ($request->hasfile("images")) {
            $destination = "uploads/customers/" . $Customers->images;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file("images");
            $filename = uniqid() . "_" . $file->getClientOriginalName();
            $file->move("uploads/customers/", $filename);
            $Customers->images = $filename;
        }
        $Customers->update();
        return Redirect::to("customer")->withSuccessMessage(
            "New Customer Updated!"
        );
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
        return Redirect::to("customer")->withSuccessMessage(
            "New Customer Deleted!"
        );
    }

    public function restore($id)
    {
        Customer::onlyTrashed()
            ->findOrFail($id)
            ->restore();
        return Redirect::route("customer.index")->withSuccessMessage(
            "New Customer Restored!"
        );
    }

    public function forceDelete($id)
    {
        $Customers = Customer::findOrFail($id);
        $destination = "uploads/customers/" . $Customers->images;
        if (File::exists($destination)) {
            File::delete($destination);
        }
        $Customers->forceDelete();
        return Redirect::route("customer.index")->withSuccessMessage(
            "New Customer Permanently Deleted!"
        );
    }
}
