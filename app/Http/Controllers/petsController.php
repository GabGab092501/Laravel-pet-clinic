<?php

namespace App\Http\Controllers;

use App\Models\Pets;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\petsRequest;

class petsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pets = Pets::join(
            "customers",
            "customers.id",
            "=",
            "pets.customer_id"
        )
            ->select(
                "customers.name",
                "pets.id",
                "pets.pets_name",
                "pets.age",
                "pets.gender",
                "pets.type",
                "pets.images",
                "pets.customer_id",
                "pets.deleted_at"
            )
            ->orderBy("pets.id", "ASC")
            ->withTrashed()
            ->paginate(6);

        return view("pets.index", ["pets" => $pets]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::pluck("name", "id");
        return view("pets.create", [
            "customers" => $customers,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(petsRequest $request)
    {
        $pets = new pets();
        $pets->pets_name = $request->input("pets_name");
        $pets->age = $request->input("age");
        $pets->gender = $request->input("gender");
        $pets->type = $request->input("type");
        $pets->customer_id = $request->input("customer_id");
        if ($request->hasfile("images")) {
            $file = $request->file("images");
            $filename = uniqid() . "_" . $file->getClientOriginalName();
            $file->move("uploads/pets/", $filename);
            $pets->images = $filename;
        }
        $pets->save();
        return Redirect::to("/pets");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pets = pets::find($id);
        $customers = Customer::pluck("name", "id");
        return view("pets.show", [
            "pets" => $pets,
            "customers" => $customers,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pets = pets::find($id);
        $customers = Customer::pluck("name", "id");
        return view("pets.edit", [
            "pets" => $pets,
            "customers" => $customers,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(petsRequest $request, $id)
    {
        $pets = pets::find($id);
        $pets->pets_name = $request->input("pets_name");
        $pets->age = $request->input("age");
        $pets->gender = $request->input("gender");
        $pets->type = $request->input("type");
        $pets->customer_id = $request->input("customer_id");
        if ($request->hasfile("images")) {
            $destination = "uploads/pets/" . $pets->images;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file("images");
            $filename = uniqid() . "_" . $file->getClientOriginalName();
            $file->move("uploads/pets/", $filename);
            $pets->images = $filename;
        }
        $pets->update();
        return Redirect::to("pets");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        pets::destroy($id);
        return Redirect::to("pets");
    }

    public function restore($id)
    {
        pets::onlyTrashed()
            ->findOrFail($id)
            ->restore();
        return Redirect::route("pets.index");
    }

    public function forceDelete($id)
    {
        $pets = pets::findOrFail($id);
        $destination = "uploads/pets/" . $pets->images;
        if (File::exists($destination)) {
            File::delete($destination);
        }
        $pets->forceDelete();
        return Redirect::route("pets.index");
    }
}