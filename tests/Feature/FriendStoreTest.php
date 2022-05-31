<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;


uses(RefreshDatabase::class);

it('redircts unauthenticated users')->expectGuest()->toBeRedirctedFor('/friends','post');

it('validate friend email', function () {
    $user = User::factory()->create();

    ActingAs($user)
        ->post('/friends')
        ->assertSessionHasErrors(['email']);
});

it('validate friend email exists in database', function () {
    $user = User::factory()->create();

    ActingAs($user)
        ->post('/friends',[
            'email' => 'eslamAbdallah@gmail.com'
        ])
        ->assertSessionHasErrors(['email']);
});

it('cont add himself as a friend', function () {
    $user = User::factory()->create();

    ActingAs($user)
        ->post('/friends',[
            'email' => $user->email
        ])
        ->assertSessionHasErrors(['email']);
});

it('store friend request', function () {

    $user = User::factory()->create();
    $friend = User::factory()->create();

    ActingAs($user)
        ->post('/friends',[
            'email' => $friend->email
        ]);

    $this->assertDatabaseHas('friends',[
        'user_id'       => $user->id,
        'friend_id'     => $friend->id,
        'accepted'      => false
    ]);

});
