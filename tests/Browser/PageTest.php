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
                ->type('input[name="title"]', 'My Test Page')
                ->type('slug', 'test-page')
                ->value('textarea[name=content]', 'Test Content')
                ->press('Create')
                ->waitFor('.snotifyToast', 1)
                ->assertSee('Created')
                ->assertInputValue('input[name=title]', 'My Test Page')
                ->assertInputValue('slug', 'test-page');
        });
    }

    public function testCanPublishAPage()
    {
        $user = factory(User::class)->create();
        $page = factory(Page::class)->create(['published_at' => null]);
        $this->browse(function (Browser $browser) use ($user, $page) {
            $browser->loginAs($user)->visit(route('pages.edit', $page))
                ->click('button[name=publish]')
                ->waitFor('.snotifyToast', 1)
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
        $page = factory(Page::class)->create();

        $this->browse(function (Browser $browser) use ($user, $page) {
            $browser->loginAs($user)->visit(route('pages.edit', $page))
                ->click('button[name=unpublish]')
                ->waitFor('.snotifyToast', 1)
                ->assertSee('Page unpublished');

                $this->assertDatabaseHas('pages', [
                    'id' => $page->id,
                    'published_at' => null,
                ]);
        });
    }
}
