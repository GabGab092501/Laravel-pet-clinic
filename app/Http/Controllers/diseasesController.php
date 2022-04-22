<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\diseases;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;

class diseasesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $diseases = diseases::all();
        return view("diseases.index", [
            "diseases" => $diseases,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make("diseases.create");   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        diseases::create($request->all());
        return Redirect::to('diseases');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $diseases = diseases::find($id);
        return view('diseases.edit', compact('diseases'));
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
        $diseases = diseases::find($id);
        $diseases->update($request->all());
        return Redirect::to('diseases');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $diseases = diseases::findOrFail($id);
        $diseases->delete();
        return Redirect::to('diseases');
    }
    public function restore($id)
    {
        diseases::onlyTrashed()->findOrFail($id)->restore();
        return Redirect::route("diseases.index");
    }
}
