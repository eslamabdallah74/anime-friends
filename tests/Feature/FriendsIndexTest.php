<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('redircts unauthenticated users')->expectGuest()->toBeRedirctedFor('/friends');

it('shows a list of pending friends', function () {

    $user       = User::factory()->create();
    $friends     = User::factory()->times(2)->create();

    $friends->each(fn ($friend) => $user->addFriend($friend));

    ActingAs($user)
        ->get('/friends')
        ->assertOk()
        ->assertSeeTextInOrder(array_merge(['Pending Friends Requests'] + $friends->pluck('name')->toArray()));

});

it('shows a list of reqested friends', function () {
    $user        = User::factory()->create();
    $friends     = User::factory()->times(2)->create();

    $friends->each(fn ($friend) => $friend->addFriend($user));

    ActingAs($user)
        ->get('/friends')
        ->assertOk()
        ->assertSeeTextInOrder(array_merge(['Friends Requests'] + $friends->pluck('name')->toArray()));

});

it('shows a list of accepted friends', function () {
    $user        = User::factory()->create();
    $friends     = User::factory()->times(2)->create();

    $friends->each(function ($friend) use ($user) {
        $user->addFriend($friend);
        $friend->acceptFriend($user);
    });

    ActingAs($user)
    ->get('/friends')
    ->assertOk()
    ->assertSeeTextInOrder(array_merge(['My Friends'] + $friends->pluck('name')->toArray()));

});
