<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(){
        return view('pages.index');
    }

    public function about(){
        $title = 'About US Page from controller';
        $body = "This is my about us page";
        return view('pages.about', compact('title','body'));
    }

    public function users($id, $comp){
        $name = 'Noor - '.$id. " COP - ".$comp;
        return view('pages.users', compact('name'));
    }
}
