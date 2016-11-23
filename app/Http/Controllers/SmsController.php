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
        if (Auth::user()->admin)
            $sms = Sms::paginate(20);
        else
            $sms = Auth::user()->sms()->paginate(20);
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

        // on reupere les valuer saisie si elle n'xiste pas on creer un tableau vide
        $groupes = is_array($request->get('groupes')) ? $request->get('groupes') : array();
        $agents = is_array($request->get('agents')) ? $request->get('agents') : array();

        // on converti les clé des tableaux groupe de string a int
        $groupes = array_map('intval', $groupes);
        $agents = array_map('intval', $agents);

        // on ajoute au tableau agents tous les agents des groupes sans doubon
        foreach (Groupe::whereIn('id', $groupes)->get() as $item) {
            foreach ($item->agents()->get() as $value) {
                if (!in_array($value->id, $agents)){
                    $agents[] = $value->id;
                }
            }
        }

        foreach ($agents as $agent) {
            // on envoi le SMS
            $reponse = HttpClient::get('http://'. \App\Ip::all()->last()->address .':9090/sendsms?phone='. Agent::findOrFail($agent)->phone .'&text='.urlencode($request->get('body')).'&password=test');
            Log::info('New SMS de : '.$user->name.' Pour : '.Agent::findOrFail($agent)->nom.' detail : '.urlencode($request->get('body')));

            $monolog = Log::getMonolog();
            $monolog->pushHandler(new StreamHandler(storage_path().'/logs/sms.log'));
            $monolog->addInfo('New SMS de : '.$user->name.' Pour : '.Agent::findOrFail($agent)->nom.' detail : '.$request->get('body'));
            $monolog->info($reponse->statusCode().' --- '.$reponse->content());
        }

        // on associe les agent destinataires au SMS
        $SMS->agents()->attach($agents);

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
