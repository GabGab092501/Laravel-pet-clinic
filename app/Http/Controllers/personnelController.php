<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\personnelRequest;
use App\Http\Requests\personnelUpdateController;
use App\Http\Requests\loginRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Personnel;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
class personnelController extends Controller
{
    public function Email(){
        return view('personnels.email');
    }

    public function Reset(){
        return view('personnels.reset');
    }

    public function getSignup(){
        return view('personnels.signup');
    }

    public function postSignup(personnelRequest $request){
         $personnels = new Personnel([
            "full_name" => $request->full_name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
            "role" => $request->role,
        ]);

         $personnels->save();
         Auth::login($personnels);
         return redirect::route('personnels.dashboard')->withSuccessMessage("New Personnel Added!");
    }

    public function Dashboard(){
        return view('personnels.dashboard');
    }

    public function getLogout(){
        Auth::logout();
        return view('personnels.signin');
    }

    public function getSignin(){
        return view('personnels.signin');
    }
    
    // public function logout()
    // {
    //     if (Session::has("id")) {
    //         Session::pull("id");
    //         return redirect("login");
    //     }
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $personnels = Personnel::withTrashed()->paginate(6);
        //$personnels = Personnel::all();
        return view("personnels.index", [
            "personnels" => $personnels,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //  return view("personnels.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(personnelRequest $request)
    {
        //  $personnels = new Personnel();
        //  $personnels->full_name = $request->input("full_name");
        //  $personnels->email = $request->input("email");
        //  $personnels->password = Hash::make($request->input("password"));
        //  $personnels->role = $request->input("role");
        //  if ($request->hasfile("images")) {
        //      $file = $request->file("images");
        //      $extension = $file->getClientOriginalExtension();
        //      $filename = time() . "." . $extension;
        //      $file->move("uploads/personnels/", $filename);
        //      $personnels->images = $filename;
        //  }
        //  $personnels->save();
        //  return Redirect::to("login")->with("success", "New Personnel Added!");
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
        $personnels = Personnel::find($id);
        return view("personnels.edit")->with("personnels", $personnels);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(personnelUpdateController $request, $id)
    {
        $personnels = Personnel::find($id);
        $personnels->full_name = $request->input("full_name");
        $personnels->email = $request->input("email");
        $personnels->password = Hash::make($request->input("password"));
        $personnels->role = $request->input("role");
        $personnels->update();
        return Redirect::to("personnel")->with(
            "success",
            "Personnel Data Updated!"
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
        Personnel::destroy($id);
        return Redirect::to("personnel")->with(
            "success",
            "Personnel Data Deleted!"
        );
    }

    public function restore($id)
    {
        Personnel::onlyTrashed()
            ->findOrFail($id)
            ->restore();
        return Redirect::route("personnel.index")->with(
            "success",
            "Personnel Data Restored!"
        );
    }

    public function forceDelete($id)
    {
        $personnels = Personnel::findOrFail($id);
        $personnels->forceDelete();
        return Redirect::route("personnel.index")->with(
            "success",
            "Personnel Data Permanently Deleted!"
        );
    }
}
