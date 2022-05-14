<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function(){
    $this->user = User::factory()->create();
});

it('only auth users can go to anime page')->post('/anime')->assertStatus(302);

it('anime validation')
    ->tap(fn() => $this->ActingAs($this->user))
    ->post('/anime')
    ->assertSessionHasErrors(['name','status']);


it('creates an anime', function() {
    $this->ActingAs($this->user)
    ->post('/anime', [
        'name'      => 'an anime',
        'url'       => 'www.anime.com',
        'status'    => 1,
    ]);
    $this->assertDatabaseHas('animes',[
        'name'      => 'an anime',
        'url'       => 'www.anime.com',
    ])
    ->assertDatabaseHas('anime_user',[
        'user_id'      => $this->user->id,
        'status'       => 1,
    ]);
});
