<?php

namespace App\Http\Controllers;

use App\helpers\customs;
use App\Http\Controllers\Controller;
use Input;
use Redirect;
use Session;
use Twitter;

class TwitterController extends Controller
{
    protected $customs;
    public function __construct(customs $customs)
    {
        $this->customs = $customs;
    }

    public function home()
    {
        return view('index');
    }

    public function login()
    {

        // our SIGN IN WITH TWITTER  button should point to this route
        $sign_in_twitter = true;
        $force_login = false;
        // Make sure we make this request w/o tokens, overwrite the default values in case of login.
        Twitter::reconfig(['token' => env('TWITTER_ACCESS_TOKEN'), 'secret' => env('TWITTER_ACCESS_TOKEN_SECRET')]);
        $token = Twitter::getRequestToken(route('twitter.callback'));

        if (isset($token['oauth_token_secret'])) {
            $url = Twitter::getAuthorizeURL($token, $sign_in_twitter, $force_login);

            Session::put('oauth_state', 'start');
            Session::put('oauth_request_token', $token['oauth_token']);
            Session::put('oauth_request_token_secret', $token['oauth_token_secret']);

            return Redirect::to($url);
        }

        return Redirect::route('twitter.error');
    }

    public function callback()
    {

        if (Session::has('oauth_request_token')) {
            $request_token = [
                'token' => Session::get('oauth_request_token'),
                'secret' => Session::get('oauth_request_token_secret'),
            ];

            Twitter::reconfig($request_token);

            $oauth_verifier = false;

            if (Input::has('oauth_verifier')) {

                $oauth_verifier = Input::get('oauth_verifier');
                // getAccessToken() will reset the token for you
                $token = Twitter::getAccessToken($oauth_verifier);
            }

            if (!isset($token['oauth_token_secret'])) {
                return Redirect::route('twitter.error')->with('flash_error', 'We could not log you in on Twitter.');
            }

            $credentials = Twitter::getCredentials();

            if (is_object($credentials) && !isset($credentials->error)) {
                // $credentials contains the Twitter user object with all the info about the user.
                // Add here your own user logic, store profiles, create new users on your tables...you name it!
                // Typically you'll want to store at least, user id, name and access tokens
                // if you want to be able to call the API on behalf of your users.

                // This is also the moment to log in your users if you're using Laravel's Auth class
                // Auth::login($user) should do the trick.

                Session::put('access_token', $token);

                return Redirect::to('/')->with('flash_notice', 'Congrats! You\'ve successfully signed in!');
            }

            return Redirect::route('twitter.error')->with('flash_error', 'Crab! Something went wrong while signing you up!');
        }
    }

    public function postTweet()
    {
        $status = request('status');
        if ($this->customs->getUser()) {
            $tweet = Twitter::postTweet(['status' => $status,'format' => 'json']);
            return back();
        } else {
            return redirect()->to('/trends/index');
        }
    }
}