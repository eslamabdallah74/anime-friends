<?php

use App\Http\Middleware\Authenticate;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function(){
    $this->user = User::factory()->create();
});

it('redirct unAuthenticated users')->post('/anime')->assertStatus(302);

it('validate an anime')
    ->tap(fn() => $this->ActingAs($this->user))
    ->post('/anime')
    ->assertSessionHasErrors(['name','status']);


it('creates an anime', function() {
    $this->ActingAs($this->user)
    ->post('/anime', [
        'name'      => 'an anime',
        'url'       => 'www.anime.com',
        'status'    => 'WATCHING',
    ]);
    $this->assertDatabaseHas('animes',[
        'name'      => 'an anime',
        'url'       => 'www.anime.com',
    ])
    ->assertDatabaseHas('anime_user',[
        'user_id'      => $this->user->id,
        'status'       => 'WATCHING',
    ]);
});

it('validate anime status')
    ->tap(fn() => $this->ActingAs($this->user))
    ->post('/anime',[
        'status'    => 'EATING'
    ])
    ->assertSessionHasErrors(['status']);
