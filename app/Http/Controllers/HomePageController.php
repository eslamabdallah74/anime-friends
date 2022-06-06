<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function __invoke(Request $request)
    {
        $animesByStatus = auth()->check() ? $request->user()->animes->groupBy('pivot.status') : 0;
        return view('home',compact('animesByStatus'));
    }
}
