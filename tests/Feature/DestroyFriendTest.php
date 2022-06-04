<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('redierct unauthenticated users')->expectGuest()->toBeRedirctedFor('/friends/1','delete');

it('makes user delete friend', function () {

    $user       = User::factory()->create();
    $friend     = User::factory()->create();

    $user->addFriend($friend);

    ActingAs($user)->delete('/friends/' . $friend->id);

    $this->assertDatabaseMissing('friends', [
        'user_id'        => $user->id,
        'friend_id'      => $friend->id,
    ]);
});

it('makes friend delete user', function () {

    $user       = User::factory()->create();
    $friend     = User::factory()->create();

    $user->addFriend($friend);

    ActingAs($friend)->delete('/friends/' . $user->id);

    $this->assertDatabaseMissing('friends', [
        'user_id'        => $user->id,
        'friend_id'      => $friend->id,
    ]);
});
