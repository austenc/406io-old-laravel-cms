<?php

namespace Tests\Browser;

use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PageTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testCreatesPage()
    {
        $user = factory(User::class)->create();
        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)->visit(route('pages.create'))
                ->type('title', 'My Test Page')
                ->type('slug', 'test-page')
                ->type('excerpt', 'Something')
                ->value('textarea[name=content]', 'Test Content')
                ->click('button[type=submit][class*="btn"]')
                ->assertSee('Page created')
                ->assertInputValue('title', 'My Test Page')
                ->assertInputValue('slug', 'test-page')
                ->assertInputValue('excerpt', 'Something');
        });
    }
}
