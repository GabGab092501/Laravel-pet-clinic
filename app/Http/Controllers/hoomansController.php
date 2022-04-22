<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\hoomansRequest;
use App\Http\Requests\hoomansEditController;
use App\Http\Requests\hoomansloginRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use App\Models\Hoomans;
use Illuminate\Support\Facades\Auth;


class hoomansController extends Controller
{
    public function getSignup()
    {
        return view("hoomans.signup");
    }

    public function postSignup(hoomansRequest $request)
    {
        $hoomans = new Hoomans();
        $hoomans->name = $request->input("name");
        $hoomans->email = $request->input("email");
        $hoomans->password = Hash::make($request->input("password"));
        $hoomans->role = $request->input("role");
        if ($request->hasfile("images")) {
            $file = $request->file("images");
            $filename = uniqid() . "_" . $file->getClientOriginalName();
            $file->move("imagefolder/hoomans/", $filename);
            $hoomans->images = $filename;
        }
    
        $hoomans->save();
        Auth::login($hoomans);
        return redirect::route("hoomans.dashboard");
    }

    public function Dashboard()
    {
        return view("hoomans.dashboard");
    }

    public function getLogout()
    {
        Auth::logout();
        return view("hoomans.signin");
    }

    public function getSignin()
    {
        return view("hoomans.signin");
    }

    public function postSignin(hoomansloginRequest $request)
    {
        if (
            Auth::attempt([
                "email" => $request->input("email"),
                "password" => $request->input("password"),
            ])
        ) {
            return redirect::route("/home");
        } else {
            return redirect()->back();
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hoomans = Hoomans::withTrashed()->paginate(10);

        return view("hoomans.index", [
            "hoomans" => $hoomans,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(hoomansRequest $request)
    {
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $hoomans = DB::table('hoomans')     
        ->select('hoomans.id', 'hoomans.name', 'hoomans.email', 'hoomans.role', 'hoomans.images')
        ->where('hoomans.id', $id)
        ->get();

    return View::make('hoomans.show', compact('hoomans'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hoomans = Hoomans::find($id);
        return view("hoomans.edit")->with("hoomans", $hoomans);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(hoomansEditController $request, $id)
    {
        $hoomans = hoomans::find($id);
        $hoomans->name = $request->input("name");
        
        $hoomans->email = $request->input("email");
        $hoomans->role = $request->input("role");
        if ($request->hasfile("images")) {
            $destination = "imagefolder/hoomans/" . $hoomans->images;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file("images");
            $filename = uniqid() . "_" . $file->getClientOriginalName();
            $file->move("imagefolder/hoomans/", $filename);
            $hoomans->images = $filename;
        }
        $hoomans->update();
        return Redirect::to("hoomans");
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Hoomans::destroy($id);
        return Redirect::to("hoomans");
    }

    public function restore($id)
    {
        Hoomans::onlyTrashed()
            ->findOrFail($id)
            ->restore();
        return Redirect::route("hoomans.index");
    }

    
}
