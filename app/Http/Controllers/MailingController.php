<?php

namespace App\Http\Controllers;

use App\Http\Requests\MailFormRequest;
use App\Models\Mailing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('emails.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MailFormRequest $request)
    {
        $email = new Mailing(array(
            'email'=>$request->get('email')
        ));
        $email->save();
        $data = array(
            'email'=>$email,
        );
        $email = $request->get('email');
        Mail::send('emails.mailing',$data,function($msg) use ($email){
            $msg->from('noreply@email.dev','Lucio Ticali');
            $msg->to($email)->subject('Mailing list');
        });
        return redirect('/')->with('status', 'Thank you for signing up for our mailing list');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mailing  $mailing
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $email = Mailing::whereId($id)->firstOrFail();
        return view('emails.delete', compact('email'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mailing  $mailing
     * @return \Illuminate\Http\Response
     */
    public function edit(Mailing $mailing)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mailing  $mailing
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mailing $mailing)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mailing  $mailing
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $email = Mailing::whereId($id)->firstOrFail();
        $email->delete();
        return redirect('/')->with('status', 'Email '.$email->email .' has been deleted!');

    }
}
