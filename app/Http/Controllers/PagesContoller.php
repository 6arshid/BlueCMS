<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;

class PagesContoller extends Controller
{
    public function get_page_detail(Page $page)
    {

        $id = $page->id;
        $rows = Page::where('id', '=', $id)->first();
        return view('page', compact('rows'));
    }
}
