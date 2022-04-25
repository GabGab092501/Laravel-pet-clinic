<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\diseaseInjury;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;

class diseaseInjuryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $diseaseInjury = diseaseInjury::withTrashed()->paginate(10);
        return view("diseaseInjury.index", [
            "disease_injury" => $diseaseInjury,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make("diseaseInjury.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        diseaseInjury::create($request->all());
        return Redirect::to('diseaseInjury');
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
        $diseaseInjury = diseaseInjury::find($id);
        return view('diseaseInjury.edit', compact('diseaseInjury'));
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
        $diseaseInjury = diseaseInjury::find($id);
        $diseaseInjury->update($request->all());
        return Redirect::to('diseaseInjury');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        diseaseInjury::destroy($id);
        return Redirect::to("diseaseInjury");
    }
    public function restore($id)
    {
        diseaseInjury::onlyTrashed()->findOrFail($id)->restore();
        return Redirect::route("diseaseInjury.index");
    }
}
