<?php

namespace Tests\Feature;

use App\Page;
use Tests\TestCase;
use Spatie\Tags\Tag;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TagsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testViewPagesByTag()
    {
        $this->withoutExceptionHandling();
        // Create a page with some tags on it
        $page = factory(Page::class)->create()->syncTags(['example']);
        $locale = app()->getLocale();

        // See on a url like /tags/example that page is listed
        $response = $this->get(route('tags.browse', 'example'));
        $response->assertViewHas('pages', Page::withAnyTags(['example'])->get());
        $response->assertViewHas('tag', Tag::where("slug->{$locale}", 'example')->first());
        $response->assertSee($page->title);
    }
}
