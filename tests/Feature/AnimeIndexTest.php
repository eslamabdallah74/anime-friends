<?php

use App\Models\Anime;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\actingAs;

uses(RefreshDatabase::class);

beforeEach(function(){
    $this->user = User::factory()->create();
});

it('shows animes with the correct status', function ($status,$heading) {
    $this->user->animes()->attach($anime = Anime::factory()->create(),[
        'status' => $status
    ]);
    ActingAs($this->user)
    ->get('/')
    ->assertSeeText($heading,$anime->name);
})->with([
    ['status' => 'WANT_TO_WATCH', 'heading' => 'Want to watch'],
    ['status' => 'WATCHING', 'heading' => 'Watching'],
    ['status' => 'WATCHED', 'heading' => 'Watched']
]);
