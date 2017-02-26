<?php

namespace App\Http\Controllers;

use App\Agent;
use App\Groupe;
use App\Sms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use HttpClient;
use Log;
use Monolog\Handler\StreamHandler;

class SmsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->id === 1)
            $sms = Sms::latest()->paginate(20);
        else
            $sms = Auth::user()->sms()->latest()->paginate(20);
        return view('sms.index', compact('sms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $agents = Agent::all();
        $groupes = Groupe::all();
        return view('sms.create', compact('agents', 'groupes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $SMS = new Sms(['body' => $request->get('body')]);
        $user = Auth::user();
        $SMS->user()->associate($user);
        $SMS->save();

        $agents = $request->get('agents');
        $ip = \App\Ip::all()->last()->address;
        $message = str_replace(' ', '+', $request->get('body'));

        $monolog = Log::getMonolog();
        $monolog->pushHandler(new StreamHandler(storage_path().'/logs/sms.log'));

        $i = 0;

        foreach ($agents as $agent) {
            $agentObj = Agent::findOrFail($agent);
            // on envoi le SMS
            $reponse = HttpClient::get('http://'. $ip .':9090/sendsms?phone='. $agentObj->phone .'&text='.$message.'&password=test');
            Log::info('New SMS de : '.$user->name.' Pour : '.$agentObj->nom.' detail : '.$message);

            $monolog->addInfo('New SMS de : '.$user->name.' Pour : '.$agentObj->nom.' detail : '.$request->get('body'));
            $monolog->info($reponse->statusCode().' --- '.$reponse->content());

            $i ++;
            sleep(1);
        }

        HttpClient::get('http://'. $ip .':9090/sendsms?phone=0659300020&text=fin+envoi+'.$i.'+sms+envoyé+Id:+'.$SMS->id.'&password=test');
        // on associe les agent destinataires au SMS
        $SMS->agents()->attach($request->get('agents'));

        return redirect(route('sms.create'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show($id)
    {
        $this->authorize('admin');
        $SMS = Sms::findOrFail($id);

        return view('sms.show', compact('SMS'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
