<?php

namespace App\Http\Controllers;

use App\Mail\contactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
use App\Models\Comment;
use App\Models\Service;
use RealRashid\SweetAlert\Facades\Alert;

class commentController extends Controller
{
    public function comment()
    {
        $services = Service::pluck("service_name", "id");
        return view("comments.comment", [
            "services" => $services,
        ]);
    }

    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function send(Request $request)
    {
        $contacts = [
            "name" => $request->name,
            "email" => $request->email,
            "feedback" => $request->feedback,
            "service_id" => $request->service_id,
        ];
        Comment::create($contacts);
        return back()->with("success", "Feedback Send");
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $contacts = Comment::join(
        //     "services",
        //     "services.id",
        //     "=",
        //     "contacts.service_id"
        // )
        //     ->select(
        //         "services.service_name",
        //         "contacts.id",
        //         "contacts.name",
        //         "contacts.email",
        //         "contacts.phone_number",
        //         "contacts.review",
        //         "contacts.service_id",
        //         "contacts.deleted_at"
        //     )
        //     ->orderBy("contacts.id", "ASC")
        //     ->withTrashed()
        //     ->paginate(6);

        // return view("comments.index", [
        //     "contacts" => $contacts,
        // ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $comments = Comment::find($id);
        $services = Service::pluck("service_name", "id");
        return view("comments.show", [
            "comments" => $comments,
            "services" => $services,
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Comment::destroy($id);
        return Redirect::to("comments");
    }

    public function restore($id)
    {
        Comment::onlyTrashed()
            ->findOrFail($id)
            ->restore();
        return Redirect::route("comments.index");
    }

    public function forceDelete($id)
    {
        $contacts = Comment::findOrFail($id);
        $contacts->forceDelete();
        return Redirect::route("comments.index");
    }
}
