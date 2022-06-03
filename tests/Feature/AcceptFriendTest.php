<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('redierct unauthenticated users')->expectGuest()->toBeRedirctedFor('/friends/1','patch');

it('accept friend request', function () {

    $user       = User::factory()->create();
    $friend     = User::factory()->create();

    $user->addFriend($friend);

    ActingAs($friend)->patch('/friends/' . $user->id);

    $this->assertDatabaseHas('friends', [
        'user_id'        => $user->id,
        'friend_id'      => $friend->id,
        'accepted'        => true
    ]);
});
