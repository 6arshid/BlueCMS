<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reaction;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function ajaxRequest()
    {
        return view('ajaxRequest');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function ajaxRequestPost(Request $request, Reaction $reaction)
    {
        $input = $request->all();
        \Log::info($input);



        $rx = $request->happy();
                        

        // switch ($request->request->input('reaction')) {
        //     case 'happy':
        //         return response()->json(['success' => "happy"]);
        //         break;

        //     case 'angry':
        //         return response()->json(['success' => "angry"]);
        //         break;

        //     case 'ill':
        //         return response()->json(['success' => "ill"]);
        //         break;
        // }

    }
}
