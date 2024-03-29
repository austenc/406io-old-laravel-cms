<?php

namespace App\Http\Controllers;

use App\Page;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function display(Page $page)
    {
        return view('pages.display')->withPage($page);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.index')->withPages(Page::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $oldTags = empty(old('tags')) ? [] : explode(',', old('tags'));
        return view('pages.create')->withOldTags(json_encode($oldTags));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'title' => 'required|min:4|unique:pages',
            'slug' => 'required|alpha_dash|unique:pages',        
        ]);

        $page = Page::create($request->only(['title', 'slug', 'content', 'excerpt']));
        $page->syncTags(explode(',', request('tags')));

        session()->flash('status', 'created');
        return redirect()->route('pages.edit', $page);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        return view('pages.edit')->withPage($page);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Page $page)
    {
        $request->validate([
            'title' => 'required|min:4|unique:pages,title,' . $page->id,
            'slug' => 'required|alpha_dash|unique:pages,slug,' . $page->id,            
        ]);

        $updated = $page->syncTags(explode(',', request('tags')))
            ->update($request->only(['title', 'slug', 'content', 'excerpt']));

        return response()->json($updated);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        //
    }

    public function publish(Page $page)
    {
        return response()->json($page->update([
            'published_at' => new Carbon
        ]));
    }

    public function unpublish(Page $page)
    {
        return response()->json($page->update([
            'published_at' => null
        ]));
    }
}
