<?php

namespace App\Http\Controllers;

use App\Page;
use Spatie\Tags\Tag;
use Illuminate\Http\Request;

class BrowseTagController extends Controller
{
    public function __invoke($slug)
    {
        $locale = app()->getLocale();
        $tag = Tag::where("slug->{$locale}", $slug)->firstOrFail();

        return view('tags.browse')
            ->withTag($tag)
            ->withPages(Page::withAnyTags($tag->name)->get());
    }
}
