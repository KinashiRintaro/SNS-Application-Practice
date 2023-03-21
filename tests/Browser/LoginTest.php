<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;

class LoginTest extends DuskTestCase
{
    /**
     * A Dusk test
     */
    public function testSuccessfulLogin(): void
    {
        $this->browse(function (Browser $browser) {
            $user = User::factory()->create();
            $browser->visit('/login')
            ->type('email', $user->email)
            ->type('password', 'password')
            ->press('LOG IN')
            ->assertPathIs('/tweet')
            ->assertSee('つぶやきアプリ');
        });
    }
}
