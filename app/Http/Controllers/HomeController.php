<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
    	return view('home')
    		->withPages(Page::orderBy('created_at', 'desc')->get());
    }
}
