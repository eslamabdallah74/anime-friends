<?php

use App\Models\Anime;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('redierct unauthenticated users')->expectGuest()->toBeRedirctedFor('/feed');

it('shows anims of friends', function () {

    $user          = User::factory()->create();
    $friendOne     = User::factory()->create();
    $friendTwo     = User::factory()->create();

    $friendOne->animes()->attach($animeOne = Anime::factory()->create(),[
        'status'        => 'WATCHING',
        'updated_at'    => now()->subDay()
    ]);

    $friendTwo->animes()->attach($animeTwo = Anime::factory()->create(),[
        'status'        => 'WANT_TO_WATCH',
        'updated_at'    => now()
    ]);

    $user->addFriend($friendOne);
    $friendOne->acceptFriend($user);

    $friendTwo->addFriend($user);
    $user->acceptFriend($friendTwo);

    ActingAs($user)
        ->get('/feed')
        ->assertSeeInOrder([
            $friendTwo->name . ' Wants to watch ' . $animeTwo->name,
            $friendOne->name .  ' Is watching ' . $animeOne->name
        ]);

});
