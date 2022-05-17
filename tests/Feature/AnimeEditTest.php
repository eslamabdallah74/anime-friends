<?php

use App\Models\Anime;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;


uses(RefreshDatabase::class);

it('redircts unauthenticated users')->expectGuest()->toBeRedirctedFor('/anime/1/edit');

it('shows anime details', function(){
    $user = User::factory()->create();
    $user->animes()->attach($anime = Anime::factory()->create(),[
        'status' => 'WATCHED'
    ]);
    // Make sure hitting the current Edit page as the same user
    ActingAs($user)->get('/anime/' . $anime->id . '/edit')->assertOk()
    ->assertSee([$anime->name])
    ->assertSee('<option value="WATCHED" selected>Watched</option>',false);
});

it('redirct user if hitting anime id does not belong to him',function (){
    $user           = User::factory()->create();
    $anotherUser    = User::factory()->create();
    $anotherUser->animes()->attach($anime = Anime::factory()->create(),[
        'status' => 'WATCHED'
    ]);
    ActingAs($user)->get('/anime/' . $anime->id . '/edit')->assertStatus(302);
});
