<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RootController extends Controller
{
    public function index(){
        //    $x = Spotify::searchTracks('Closed on Sunday')->get();
    
        return view('contact');
    
        }
}
