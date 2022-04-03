<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\animalRequest;
use RealRashid\SweetAlert\Facades\Alert;

class animalController extends Controller
{
    // public function search()
    // {
    //     $animals = Animal::leftJoin(
    //         "animal_disease_injury",
    //         "animals.id",
    //         "=",
    //         "animal_disease_injury.animals_id"
    //     )
    //         ->leftJoin(
    //             "disease_injuries",
    //             "disease_injuries.id",
    //             "=",
    //             "animal_disease_injury.disease_injury_id"
    //         )
    //         ->select(
    //             "disease_injuries.classify",
    //             "animals.id",
    //             "animals.animal_name",
    //             "animals.age",
    //             "animals.gender",
    //             "animals.type",
    //             "animals.images"
    //         )
    //         ->orderBy("animals.id", "ASC")
    //         ->get();
    //     return view("animals.search", [
    //         "animals" => $animals,
    //     ]);
    // }

    // public function result()
    // {
    //     $result = $_GET["result"];
    //     $animals = Animal::leftJoin(
    //         "animal_disease_injury",
    //         "animals.id",
    //         "=",
    //         "animal_disease_injury.animals_id"
    //     )
    //         ->leftJoin(
    //             "disease_injuries",
    //             "disease_injuries.id",
    //             "=",
    //             "animal_disease_injury.disease_injury_id"
    //         )
    //         ->select(
    //             "animals.id",
    //             "animals.animal_name",
    //             "animals.age",
    //             "animals.gender",
    //             "animals.type",
    //             "animals.images"
    //         )

    //         ->where("animals.animal_name", "LIKE", "%" . $result . "%")
    //         ->get();
    //     return view("animals.result", [
    //         "animals" => $animals,
    //     ]);
    // }
    //commented but will be needed soon
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $animals = Animal::join(
            "customers",
            "customers.id",
            "=",
            "animals.customer_id"
        )
            ->select(
                "customers.first_name",
                "animals.id",
                "animals.animal_name",
                "animals.age",
                "animals.gender",
                "animals.type",
                "animals.images",
                "animals.customer_id",
                "animals.deleted_at"
            )
            ->orderBy("animals.id", "ASC")
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

        return view("animals.index", ["animals" => $animals]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::pluck("first_name", "id");
        return view("animals.create", [
            "customers" => $customers,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(animalRequest $request)
    {
        $animals = new Animal();
        $animals->animal_name = $request->input("animal_name");
        $animals->age = $request->input("age");
        $animals->gender = $request->input("gender");
        $animals->type = $request->input("type");
        $animals->customer_id = $request->input("customer_id");
        if ($request->hasfile("images")) {
            $file = $request->file("images");
            $filename = uniqid() . "_" . $file->getClientOriginalName();
            $file->move("uploads/animals/", $filename);
            $animals->images = $filename;
        }
        $animals->save();
        return Redirect::to("/animals")->withSuccessMessage(
            "New Animal Added!"
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
        $animals = Animal::find($id);
        $customers = Customer::pluck("first_name", "id");
        return view("animals.show", [
            "animals" => $animals,
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
        $animals = Animal::find($id);
        $customers = Customer::pluck("first_name", "id");
        return view("animals.edit", [
            "animals" => $animals,
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
    public function update(animalRequest $request, $id)
    {
        $animals = Animal::find($id);
        $animals->animal_name = $request->input("animal_name");
        $animals->age = $request->input("age");
        $animals->gender = $request->input("gender");
        $animals->type = $request->input("type");
        $animals->customer_id = $request->input("customer_id");
        if ($request->hasfile("images")) {
            $destination = "uploads/animals/" . $animals->images;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file("images");
            $filename = uniqid() . "_" . $file->getClientOriginalName();
            $file->move("uploads/animals/", $filename);
            $animals->images = $filename;
        }
        $animals->update();
        return Redirect::to("/animals")->withSuccessMessage(
            "Animal Data Updated!"
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
        Animal::destroy($id);
        return Redirect::to("/animals")->withSuccessMessage(
            "Animal Data Deleted!"
        );
    }

    public function restore($id)
    {
        Animal::onlyTrashed()
            ->findOrFail($id)
            ->restore();
        return Redirect::route("animals.index")->withSuccessMessage(
            "Animal Data Restored!"
        );
    }

    public function forceDelete($id)
    {
        $animals = Animal::findOrFail($id);
        $destination = "uploads/animals/" . $animals->images;
        if (File::exists($destination)) {
            File::delete($destination);
        }
        $animals->forceDelete();
        return Redirect::route("animals.index")->withSuccessMessage(
            "Animal Data Permanently Deleted!"
        );
    }
}
