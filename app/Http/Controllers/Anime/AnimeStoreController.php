<?php

namespace App\Http\Controllers\Anime;

use App\Http\Controllers\Controller;
use App\Models\Anime;
use Illuminate\Http\Request;

class AnimeStoreController extends Controller
{
    public function __invoke(Request $request)
    {
        // Valdation
        $this->validate($request,[
            'name'      => 'required|min:2|max:20',
            'url'       => 'nullable|min:2|max:40',
            'status'    => 'required'
        ]);
        $anime = Anime::create($request->only(['name','url']));
        $request->user()->animes()->attach($anime ,[
            'status' => $request->status,
        ]);
        return redirect('/');
    }
}
