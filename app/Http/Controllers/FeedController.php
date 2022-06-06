<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FeedController extends Controller
{
    public function __invoke(Request $request)
    {
        $animes = $request->user()->animesOfFriends;
        return view('feed.index',compact('animes'));
    }
}
