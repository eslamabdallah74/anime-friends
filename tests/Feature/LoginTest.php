<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\assertAuthenticatedAs;
use function Pest\Laravel\get;
use function Pest\Laravel\post;

uses(RefreshDatabase::class);


it('redirct auth user', function(){
    expect(User::factory()->create())->toBeRedirctedFor('/login');
});

it('shows login page')->get('/login')->assertStatus(200);

it('shows an error if credentials are incorrect')
    ->post('/login')
    ->assertSessionHasErrors(['email','password']);

it('user logging in', function(){
    $user = User::factory()->create([
        'password' => bcrypt('password')
    ]);
    post('/login', [
        'email'     => $user->email,
        'password'  => 'password'
    ])
    ->assertRedirect('/');
    $this->assertAuthenticated();

});
