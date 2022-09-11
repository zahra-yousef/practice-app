<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(){
        return view('welcome');
    }

    public function about(){
        $title = 'About US Page from controller';
        $body = "This is my about us page";
        return view('pages.about', compact('title','body'));
    }

    public function users($id, $cop){
        $name = 'Noor - '.$id. " COP - ".$cop;
        return view('pages.users', compact('name'));
    }
}
