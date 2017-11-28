<?php

namespace Tests\Browser;

use App\User;
use App\Page;
use Carbon\Carbon;
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

    public function testCanPublishAPage()
    {
        $user = factory(User::class)->create();
        $page = factory(Page::class)->create();
        $this->browse(function (Browser $browser) use ($user, $page) {
            $browser->loginAs($user)->visit(route('pages.edit', $page))
                ->click('button[name=publish]')
                ->assertSee('Page published');

                $this->assertDatabaseMissing('pages', [
                    'id' => $page->id,
                    'published_at' => null,
                ]);
        });
    }

    public function testCanUnpublishAPage()
    {
        $user = factory(User::class)->create();
        $page = factory(Page::class)->create(['published_at' => new Carbon]);

        $this->browse(function (Browser $browser) use ($user, $page) {
            $browser->loginAs($user)->visit(route('pages.edit', $page))
                ->click('button[name=unpublish]')
                ->assertSee('Page unpublished');

                $this->assertDatabaseHas('pages', [
                    'id' => $page->id,
                    'published_at' => null,
                ]);
        });
    }
}
