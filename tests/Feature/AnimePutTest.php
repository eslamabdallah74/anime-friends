<?php

use App\Models\Anime;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('redierct unauthenticated users')->expectGuest()->toBeRedirctedFor('/anime/1','put');

it('fails if anime not found', function () {
    ActingAs(User::factory()->create())->put('/anime/1')->assertStatus(404);
});

it('validate the request details', function () {
    $user = User::factory()->create();
    $user->animes()->attach($anime = Anime::factory()->create(), [
        'status' => 'WANT_TO_READ'
    ]);
    ActingAs($user)
    ->put('/anime/' . $anime->id)
    ->assertSessionHasErrors(['name','status']);
});

it('redirct user if hitting anime id does not belong to him',function (){
    $user           = User::factory()->create();
    $anotherUser    = User::factory()->create();
    $anotherUser->animes()->attach($anime = Anime::factory()->create(),[
        'status' => 'WATCHED'
    ]);
    ActingAs($user)->put('/anime/' . $anime->id)->assertStatus(302);
});

it('update the anime', function () {
    $user = User::factory()->create();
    $user->animes()->attach($anime = Anime::factory()->create(), [
        'status' => 'WATCHED'
    ]);

    ActingAs($user)->put('/anime/' . $anime->id , [
        'name'      => 'updated anime',
        'status'    => 'WANT_TO_WATCH'
    ]);
    $this->assertDatabaseHas('animes', [
        'id'        => $anime->id,
        'name'      => 'updated anime',
    ]);
    $this->assertDatabaseHas('anime_user',[
        'anime_id'  => $anime->id,
        'user_id'   => $user->id,
        'status'    => 'WANT_TO_WATCH'
    ]);
});
