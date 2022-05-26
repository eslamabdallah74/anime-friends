<?php

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| The closure you provide to your test functions is always bound to a specific PHPUnit test
| case class. By default, that class is "PHPUnit\Framework\TestCase". Of course, you may
| need to change it using the "uses()" function to bind a different classes or traits.
|
*/

use App\Models\User;

uses(Tests\TestCase::class)->in('Feature','Unit');

/*
|--------------------------------------------------------------------------
| Expectations
|--------------------------------------------------------------------------
|
| When you're writing tests, you often need to check that values meet certain conditions. The
| "expect()" function gives you access to a set of "expectations" methods that you can use
| to assert different things. Of course, you may extend the Expectation API at any time.
|
*/

    // Redirct users Test
expect()->extend('toBeRedirctedFor', function (string $url, string $method = 'get') {
    // Creating Response value and set it to null
    $response = null;
    if(!$this->value)
    {
        $response = test()->{$method}($url);
    } else {
        $response = ActingAs($this->value)->{$method}($url);
    }
    // Return respone with status 302 to Redircted users
    return $response->assertStatus(302);
});

/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| While Pest is very powerful out-of-the-box, you may have some testing code specific to your
| project that you don't want to repeat in every file. Here you can also expose helpers as
| global functions to help you to reduce the number of lines of code in your test files.
|
*/

function ActingAs($user)
{
    return test()->actingAs($user);
}

function expectGuest()
{
    return test()->expect(null);
}
