<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\personnelRequest;
use App\Http\Requests\personnelUpdateController;
use App\Http\Requests\loginRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use App\Models\Personnel;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class personnelController extends Controller
{
    public function Email()
    {
        return view("personnels.email");
    }

    public function Reset()
    {
        return view("personnels.reset");
    }

    public function getSignup()
    {
        return view("personnels.signup");
    }

    public function postSignup(personnelRequest $request)
    {
        $personnels = new Personnel();
        $personnels->full_name = $request->input("full_name");
        $personnels->email = $request->input("email");
        $personnels->password = Hash::make($request->input("password"));
        $personnels->role = $request->input("role");
        if ($request->hasfile("images")) {
            $file = $request->file("images");
            $extension = $file->getClientOriginalExtension();
            $filename = time() . "." . $extension;
            $file->move("uploads/personnels/", $filename);
            $personnels->images = $filename;
        }
        $personnels->save();
        Auth::login($personnels);
        return redirect::route("personnels.dashboard")->withSuccessMessage(
            "New Personnel Added!"
        );
    }

    public function Dashboard()
    {
        return view("personnels.dashboard");
    }

    public function getLogout()
    {
        Auth::logout();
        return view("personnels.signin");
    }

    public function getSignin()
    {
        return view("personnels.signin");
    }

    public function postSignin(loginRequest $request)
    {
        if (
            Auth::attempt([
                "email" => $request->input("email"),
                "password" => $request->input("password"),
            ])
        ) {
            return redirect::route("personnels.dashboard");
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
        $personnels = Personnel::withTrashed()->paginate(6);
        //$personnels = Personnel::all();

        if (session(key: "success_message")) {
            Alert::image(
                "Congratulations!",
                session(key: "success_message"),
                "https://media0.giphy.com/media/1YcLOSW6JCNdsfSr5E/giphy.gif?cid=790b76115cd3d732681c09d4b2ea920e8c940bcfdb2711a6&rid=giphy.gif&ct=s",
                "300",
                "200",
                "I Am A Pic"
            );
        }

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
        // return view("personnels.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(personnelRequest $request)
    {
        // $personnels = new Personnel();
        // $personnels->full_name = $request->input("full_name");
        // $personnels->email = $request->input("email");
        // $personnels->password = Hash::make($request->input("password"));
        // $personnels->role = $request->input("role");
        // if ($request->hasfile("images")) {
        //     $file = $request->file("images");
        //     $extension = $file->getClientOriginalExtension();
        //     $filename = time() . "." . $extension;
        //     $file->move("uploads/personnels/", $filename);
        //     $personnels->images = $filename;
        // }
        // $personnels->save();
        // return Redirect::to("login")->with("success", "New Personnel Added!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $personnels = DB::table('personnels')
            ->select('personnels.id', 'personnels.full_name', 'personnels.email', 'personnels.role', 'personnels.images')
            ->where('personnels.id', $id)
            ->get();

        return View::make('personnels.show', compact('personnels'));
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
        $personnels->role = $request->input("role");
        if ($request->hasfile("images")) {
            $destination = "uploads/personnels/" . $personnels->images;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file("images");
            $filename = uniqid() . "_" . $file->getClientOriginalName();
            $file->move("uploads/personnels/", $filename);
            $personnels->images = $filename;
        }
        $personnels->update();
        return Redirect::to("personnel")->withSuccessMessage(
            "New Personnel Data Updated!"
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
        return Redirect::to("personnel")->withSuccessMessage(
            "New Personnel Data Deleted!"
        );
    }

    public function restore($id)
    {
        Personnel::onlyTrashed()
            ->findOrFail($id)
            ->restore();
        return Redirect::route("personnel.index")->withSuccessMessage(
            "New Personnel Data Restored!"
        );
    }

    public function forceDelete($id)
    {
        $personnels = Personnel::findOrFail($id);
        $destination = "uploads/personnels/" . $personnels->images;
        if (File::exists($destination)) {
            File::delete($destination);
        }
        $personnels->forceDelete();
        return Redirect::route("personnel.index")->withSuccessMessage(
            "New Personnel Permanently Deleted!"
        );
    }
}
