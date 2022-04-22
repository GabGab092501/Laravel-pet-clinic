<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Classify;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;

class classifyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classify = Classify::all();
        return view("classify.index", [
            "classify" => $classify,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make("classify.create");   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Classify::create($request->all());
        return Redirect::to('classify');
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
        $classify = Classify::find($id);
        return view('classify.edit', compact('classify'));
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
        $classify = Classify::find($id);
        $classify->update($request->all());
        return Redirect::to('/classify');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $classify = Classify::findOrFail($id);
        $classify->delete();
        return Redirect::to('classify');
    }
    public function restore($id)
    {
        Classify::onlyTrashed()->findOrFail($id)->restore();
        return Redirect::route("classify.index");
    }
    
}
