<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class FriendsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pendingFriends     = $request->user()->pendingFriendsOfMain;
        $friendsRequests    = $request->user()->pendingFriendsOf;
        $ourFriends         = $request->user()->friends;

        return view('friends.index',compact('pendingFriends','friendsRequests','ourFriends'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'email'     => ['required','exists:users,email',Rule::notIn([$request->user()->email])]
        ]);

        $request->user()->addFriend(User::whereEmail($request->email)->first());
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(User $friend,Request $request)
    {
        $acceptFriend   = $request->user()->pendingFriendsOf()->updateExistingPivot($friend,[
            'accepted'  => true
        ]);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,User $friend)
    {
        $deleteFriend = $request->user()->deleteFriend($friend);
        return back();
    }
}
