<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        $title = 'Welcome to ZapFile';
        return view('pages.index')->with('title', $title);
    }
    public function about(){
        $title = 'About ZapFile';
        return view('pages.about')->with('title', $title);
    }
}
