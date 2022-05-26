<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
uses(RefreshDatabase::class);

it('can have pending friends', function () {
    $user   = User::factory()->create();
    $friend = User::factory()->create();

    $user->addFriend($friend);
    // expect user to have pending friends
    expect($user->pendingFriendsOfMain)->toHaveCount(1);
});


it('can have friends requests', function () {
    $user = User::factory()->create();
    $friend = User::factory()->create();

    $friend->addFriend($user);
    // expect user to have friends requests
    expect($user->pendingFriendsOf)->toHaveCount(1);
});

it('doesnt add same friend twice', function () {
    $user = User::factory()->create();
    $friend = User::factory()->create();

    $user->addFriend($friend);
    $user->addFriend($friend);

    expect($user->pendingFriendsOfMain)->not()->toHaveCount(2);
});

it('accept friends request', function () {
    $user = User::factory()->create();
    $friend = User::factory()->create();

    $user->addFriend($friend);
    $friend->acceptFriend($user);

    expect($user->acceptFriendsOfMain)->toHaveCount(1);
    expect($user->acceptFriendsOfMain->pluck('id'))->toContain($friend->id);

});
