<?php 

namespace App\helpers;
use Twitter;
class customs
{
    public function __construct()
    {

    }

    public function getUser()
    {
        // dd(session()->get('access_token'));
        if (session()->has('access_token')) {
            $tok = session()->get('access_token');
            $u = ['user_id' => $tok['user_id']];
            $user = Twitter::getUsers($u);
            session()->put('logged_in_user_details', $user);
            return true;
        }
    }

}