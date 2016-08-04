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
            Ip::create(['address'=> $request->ip()]);
            echo 'ok';
        }
    }
}
