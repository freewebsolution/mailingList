<?php

namespace App\Http\Controllers;

use App\service\MailSendServiceDto;
use App\service\MyNewsletterService;
use App\Http\Requests\MailFormRequest;
use App\Http\Requests\ShowRequest;
use App\Models\Mailing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Spatie\Newsletter\NewsletterFacade as Newsletter;

class MailingController extends Controller
{
    private $newsletterService;

    public function __construct(MyNewsletterService $service)
    {
        $this->newsletterService = $service;
    }

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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(MailFormRequest $request)
    {
        $email = new Mailing(array(
            'email' => $request->get('email')
        ));
        $email->save();
        try {
            $emailFrom =config('mailing.emailFrom');
            $aliasFrom =Config::get('mailing.aliasFrom');
            $subject =Config::get('mailing.subject');
            $msg = 'Grazie ' . $email->email . ' '. $email->id . ' per essetti iscritto!';
            $dto = MailSendServiceDto::create($email,$emailFrom,$aliasFrom,$subject);
            $this->newsletterService->execute($dto);
            return redirect()->back()->with('status', $msg);


        } catch (\Exception $e) {
            $msg = $e->getMessage(). ' ' . $e->getFile() . ' ' . $e->getLine();
            return redirect()->back()->with('error', $msg);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Mailing $mailing
     * @return \Illuminate\Http\Response
     */
    public function show(int $id, ShowRequest $request)
    {
        $email = Mailing::whereId($id)->firstOrFail();
        return view('emails.delete', compact('email'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Mailing $mailing
     * @return \Illuminate\Http\Response
     */
    public function edit(Mailing $mailing)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Mailing $mailing
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mailing $mailing)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Mailing $mailing
     * @return \Illuminate\Http\Response
     */

    public function destroy(int $id, ShowRequest $request)
    {
        $email = Mailing::whereId($id)->firstOrFail();
        Newsletter::delete($email->email);
        $email->delete();
        return redirect('/')->with('status', 'Email ' . $email->email . ' has been deleted!');

    }
}
