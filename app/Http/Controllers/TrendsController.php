<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Twitter;

class TrendsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'id' => '1'
        ];
        $tweetData = Twitter::getTrendsPlace($data);
        session()->put('trending_hashtags',$tweetData[0]->trends);
        $tweetData = array_slice($tweetData[0]->trends,0,5);
        return view('trends',compact(['tweetData']));
    }

    public function tweets()
    {
        $hashName = request('hashtag');
        $searchData = Twitter::getSearch(['q' => $hashName]);
        $searchData = json_decode(json_encode($searchData),true);
        
        return view('tweets',compact(['searchData']));
    }
}
