<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use App\Models\Pivot\AnimeUser;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AnimeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('anime.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('anime.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Valdation
        $this->validate($request,[
            'name'      => 'required|min:2|max:30',
            'url'       => 'nullable|min:2|max:200',
            'status'    => ['required', Rule::in(array_keys(AnimeUser::$status))],
        ]);
        $anime = Anime::create($request->only(['name','url']));
        $request->user()->animes()->attach($anime ,[
            'status' => $request->status,
        ]);
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Anime $anime,Request $request)
    {
        if(!$anime = $request->user()->animes()->find($anime->id))
        {
            // Return user when hitting anime ID doesn't belong to him
            return redirect('/');
        }
        return view('anime.edit',[
            'anime' => $anime
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Anime $anime,Request $request)
    {
        // Valdation
        $this->validate($request,[
            'name'      => 'required|min:2|max:30',
            'url'       => 'nullable|min:2|max:200',
            'status'    => ['required', Rule::in(array_keys(AnimeUser::$status))],
        ]);
        $anime->update($request->only(['name','url']));
        $request->user()->animes()->updateExistingPivot($anime, [
            'status' => $request->status,
        ]);
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
