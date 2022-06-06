<?php

use App\Models\Anime;
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
    $user   = User::factory()->create();
    $friend = User::factory()->create();

    $user->addFriend($friend);
    $friend->acceptFriend($user);

    expect($user->acceptFriendsOfMain)->toHaveCount(1);
    expect($user->acceptFriendsOfMain->pluck('id'))->toContain($friend->id);

});

it('can get all friends', function () {
    $user           = User::factory()->create();
    $friend         = User::factory()->create();
    $anotherFriend  = User::factory()->create();

    $user->addFriend($friend);
    $user->addFriend($anotherFriend);

    $friend->acceptFriend($user);

    expect($user->friends)->toHaveCount(1);
    expect($friend->friends)->toHaveCount(1);
    expect($anotherFriend->friends)->toHaveCount(0);

});

it('can remove a friend', function () {
    $user           = User::factory()->create();
    $friend         = User::factory()->create();

    $user->addFriend($friend);
    $friend->acceptFriend($user);

    $user->deleteFriend($friend);

    expect($user->friends)->toHaveCount(0);
    expect($friend->friends)->toHaveCount(0);
});

it('can get animes of friends', function () {

    $user               = User::factory()->create();
    $friendOne          = User::factory()->create();
    $friendTwo          = User::factory()->create();
    $friendThree        = User::factory()->create();

    $friendOne->animes()->attach($anime = Anime::factory()->create(),[
        'status'        => 'WANT_TO_WATCH',
        'updated_at'    => now(),
    ]);
    $friendTwo->animes()->attach($animeTwo  = Anime::factory()->create(),[
        'status'        => 'WANT_TO_WATCH',
        'updated_at'    => now()->addDay(),
    ]);
    $friendThree->animes()->attach($animeThree  = Anime::factory()->create(),[
        'status'    => 'WANT_TO_WATCH'
    ]);

    $user->addFriend($friendOne);
    $friendOne->acceptFriend($user);

    $friendTwo->addFriend($user);
    $user->acceptFriend($friendTwo);

    $user->addFriend($friendThree);

    expect($user->animesOfFriends)
        ->count()->toBe(2)
        ->first()->name->toBe($animeTwo->name);

});
