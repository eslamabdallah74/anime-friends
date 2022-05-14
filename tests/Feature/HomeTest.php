<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

use function Pest\Laravel\get;



it('greets the guests', function () {
    get('/')
    ->assertSee('Anime Friends')
    ->assertSee('Sign up to get started')
    ->assertDontSee(['Feed']);
});

it('shows navbar if user logged in', function () {
    $user = User::factory()->create();
    $this->ActingAs($user)
    ->get('/')
    ->assertSeeText([$user->name,'Feed','My Anime','Add Anime','Logout']);
});

it('shows navbar if user is not logged in', function () {
    get('/')
    ->assertSeeText(['Login','Register','Home']);
});
