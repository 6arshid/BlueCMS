<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;
class SocialAuthController extends Controller
{
    public function redirect($service) {
        return Socialite::driver ( $service )->redirect ();
    }
    public function callback($service) {
        $user = Socialite::with ( $service )->user ();
        return view ( 'home' )->withDetails ( $user )->withService ( $service );
    }
}
