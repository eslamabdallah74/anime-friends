<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function __invoke(Request $request)
    {
        // dd($request->user()?->animes->groupBy('pivot.status'));
        return view('home',[
            'animesByStatus' => $request->user()?->animes->groupBy('pivot.status'),
        ]);
    }
}
