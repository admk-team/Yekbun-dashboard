<?php

namespace App\Http\Controllers\Api;

use Share;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FeedController extends Controller
{

    public function shareWidget(){
        $shareComponent =  Share::page('https://www.codesolutionstuff.com/generate-rss-feed-in-laravel/','dummy text')
        ->facebook()
        ->whatsapp()
        ->twitter()
        ->linkedin()
        ->reddit()
        ->telegram();

        return view('content.dummy' , compact('shareComponent'));
    }
}
