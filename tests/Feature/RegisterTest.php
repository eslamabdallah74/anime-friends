<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\post;
uses(RefreshDatabase::class);

it('redirct auth user', function(){
    expect(User::factory()->create())->toBeRedirctedFor('/register');
});

it('shows register page')->get('/register')->assertStatus(200);

it('if user leave input empty')
    ->post('/register')
    ->assertSessionHasErrors(['name','email','password']);

it('registers a new user')
    // Assign response to the function to use be able to use "assertDatabaseHas"
    ->tap(
        fn() =>
        $this->post('/register',[
            'name'              => 'eslam',
            'email'             => 'eslam@gmail.com',
            'password'          => 'eslam1020',
        ])
        ->assertRedirect('/')
        )
    ->assertDatabaseHas('users',[
        'name'  => 'eslam',
        'email' => 'eslam@gmail.com'])
    ->assertAuthenticated();
