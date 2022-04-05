<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Personnel;
use App\Models\Animal;
use App\Models\Consultation;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\consultationRequest;
use RealRashid\SweetAlert\Facades\Alert;

class consultationController extends Controller
{

    public function search()
    {
        $consultations = Consultation::join(
            "personnels",
            "personnels.id",
            "=",
            "consultations.personnel_id"
        )
            ->join(
                "animals",
                "animals.id",
                "=",
                "consultations.animal_id"
            )
            ->select(
                "personnels.full_name",
                "animals.animal_name",
                "consultations.id",
                "consultations.date",
                "consultations.disease_injury",
                "consultations.price",
                "consultations.comment",
                "consultations.personnel_id",
                "consultations.animal_id",
                "consultations.deleted_at"
            )
            ->orderBy("consultations.id", "ASC")
            ->get();
        return view("consultations.search", [
            "consultations" => $consultations,
        ]);
    }

    public function result()
    {
        $result = $_GET["result"];
        $consultations = Consultation::join(
            "personnels",
            "personnels.id",
            "=",
            "consultations.personnel_id"
        )
            ->join(
                "animals",
                "animals.id",
                "=",
                "consultations.animal_id"
            )
            ->select(
                "personnels.full_name",
                "animals.animal_name",
                "consultations.id",
                "consultations.date",
                "consultations.disease_injury",
                "consultations.price",
                "consultations.comment",
                "consultations.personnel_id",
                "consultations.animal_id",
                "consultations.deleted_at"
            )

            ->where("animals.animal_name", "LIKE", "%" . $result . "%")
            ->get();
        return view("consultations.result", [
            "consultations" => $consultations,
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $consultations = Consultation::join(
            "personnels",
            "personnels.id",
            "=",
            "consultations.personnel_id"
        )
            ->join(
                "animals",
                "animals.id",
                "=",
                "consultations.animal_id"
            )
            ->select(
                "personnels.full_name",
                "animals.animal_name",
                "consultations.id",
                "consultations.date",
                "consultations.disease_injury",
                "consultations.price",
                "consultations.comment",
                "consultations.personnel_id",
                "consultations.animal_id",
                "consultations.deleted_at"
            )
            ->orderBy("consultations.id", "ASC")
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

        return view("consultations.index", ["consultations" => $consultations]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $animals = Animal::pluck("animal_name", "id");
        $personnels = Personnel::pluck("full_name", "id");
        return view("consultations.create", [
            "animals" => $animals,
            "personnels" => $personnels
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $consultations = new Consultation();
            $consultations->date = $request->input("date");
            $consultations->disease_injury = $request->input("disease_injury");
            $consultations->price = $request->input("price");
            $consultations->comment = $request->input("comment");
            $consultations->personnel_id = $request->input("personnel_id");
            $consultations->animal_id = $request->input("animal_id");
            $consultations->save();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('consultation.index')->with(
                "error",
                $e->getMessage()
            );
        }
        DB::commit();
        return Redirect::to("/consultation")->withSuccessMessage(
            "New Consultation Data Added!"
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
        $consultations = Consultation::find($id);
        $animals = Animal::pluck("animal_name", "id");
        $personnels = Personnel::pluck("full_name", "id");
        return view("consultations.show", [
            "animals" => $animals,
            "personnels" => $personnels,
            "consultations" => $consultations
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
        $consultations = Consultation::find($id);
        $animals = Animal::pluck("animal_name", "id");
        $personnels = Personnel::pluck("full_name", "id");
        return view("consultations.edit", [
            "animals" => $animals,
            "personnels" => $personnels,
            "consultations" => $consultations
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(consultationRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $consultations = Consultation::find($id);
            $consultations->date = $request->input("date");
            $consultations->disease_injury = $request->input("disease_injury");
            $consultations->price = $request->input("price");
            $consultations->comment = $request->input("comment");
            $consultations->personnel_id = $request->input("personnel_id");
            $consultations->animal_id = $request->input("animal_id");
            $consultations->update();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('consultation.index')->with(
                "error",
                $e->getMessage()
            );
        }
        DB::commit();
        return Redirect::to("/consultation")->withSuccessMessage(
            "New Consultation Data Updated!"
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
        Consultation::destroy($id);
        return Redirect::route("consultation.index")->withSuccessMessage(
            "Consultation Data Deleted!"
        );
    }

    public function restore($id)
    {
        Consultation::onlyTrashed()
            ->findOrFail($id)
            ->restore();
        return Redirect::route("consultation.index")->withSuccessMessage(
            "Consultation Data Restored!"
        );
    }

    public function forceDelete($id)
    {
        Consultation::findOrFail($id)->forceDelete();
        return Redirect::route("consultation.index")->withSuccessMessage(
            "Consultation Data Permanently Deleted!"
        );
    }
}
