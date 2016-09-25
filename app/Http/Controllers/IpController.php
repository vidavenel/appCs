<?php

namespace App\Http\Controllers;

use App\Ip;
use Illuminate\Http\Request;

use App\Http\Requests;

class IpController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->get('key') === 'centreDeSecoursAups'){
            $ipAddress = $_SERVER['REMOTE_ADDR'];
	    if (array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER)) {
    		$ipAddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
	    }
            Ip::create(['address'=> $ipAddress]);
            echo 'ok';
        }
    }
}
