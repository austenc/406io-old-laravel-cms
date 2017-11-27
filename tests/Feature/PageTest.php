<?php

namespace Tests\Feature;

use App\User;
use App\Page;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PageTest extends TestCase
{
    use RefreshDatabase;

    private $page = [
        'title' => 'Test Page',
        'slug' => 'example-page',
        'content' => 'Example Content',
        'excerpt' => 'This is an example',
    ];

    public function testCreate()
    {
        // Create a user
        $user = factory(User::class)->create();

        // Log in and create a page via the store route
        $response = $this->actingAs($user)->followingRedirects()
            ->post(route('pages.store'), $this->page);
        
        // See that page's info and that it is in the database
        $this->assertDatabaseHas('pages', $this->page);
    }

    public function testEdit()
    {
        // Create a user
        $user = factory(User::class)->create();
        $page = factory(Page::class)->create($this->page);

        $this->page['title'] = 'New Page';
        $this->page['excerpt'] = 'Something';

        $response = $this->actingAs($user)->followingRedirects()
            ->put(route('pages.update', $page), $this->page);

        $this->assertDatabaseHas('pages', $this->page);
    }

    public function testExcerptShowsOnPostsPage()
    {
        $user = factory(User::class)->create();
        $page = factory(Page::class)->create($this->page);
        $response = $this->get('/');
        $response->assertSee($this->page['excerpt']);
    }

    public function testExcerptDefaultsToContent()
    {
        unset($this->page['excerpt']);
        $user = factory(User::class)->create();
        $page = factory(Page::class)->create($this->page);
        $response = $this->get('/');
        $response->assertSee($this->page['content']);        
    }
}
