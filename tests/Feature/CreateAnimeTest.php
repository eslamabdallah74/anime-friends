<?php

use App\Models\Pivot\AnimeUser;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);
use function Pest\Laravel\get;
use function Pest\Laravel\post;

it('only allows authenticated users')->expectGuest()->toBeRedirctedFor('/anime/create');


it('see status in order',function(){
    $user = User::factory()->create();
    $this->ActingAs($user)
    ->get('anime/create')
    ->assertSeeTextInOrder(AnimeUser::$status);
});

