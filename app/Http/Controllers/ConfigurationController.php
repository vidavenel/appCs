<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;

class ConfigurationController extends Controller
{
    public function index(){
        $mail = Config::get('mail');
        return view('configuration.index', compact('mail'));
    }

    public function update(Request $request){
        $path = base_path('.env');
        file_put_contents($path, str_replace('MAIL_HOST='.Config::get('mail.host'), 'MAIL_HOST='.$request->get('mail')['host'], file_get_contents($path)));
        file_put_contents($path, str_replace('MAIL_HOST='.Config::get('mail.port'), 'MAIL_PORT='.$request->get('mail')['port'], file_get_contents($path)));
        file_put_contents($path, str_replace('MAIL_HOST='.Config::get('mail.username'), 'MAIL_USERNAME='.$request->get('mail')['username'], file_get_contents($path)));
        file_put_contents($path, str_replace('MAIL_HOST='.Config::get('mail.password'), 'MAIL_PASSWORD='.$request->get('mail')['password'], file_get_contents($path)));
        return redirect(action('ConfigurationController@index'));
    }

    public function sendTestMail(Request $request){
        Mail::to($request->get('to'))->send('test');
    }
}
