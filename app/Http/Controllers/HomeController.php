<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            /*if(!Auth::check()){
                return redirect('login');
            }*/
            return view('home');
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function post()
    {
        try {
            if(!Auth::check()){
                return view('post');
            }
            return view('home');
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function image()
    {
        try {
            if(!Auth::check()){
                return view('image');
            }
            return view('home');
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function video()
    {
        try {
            if(!Auth::check()){
                return view('video');
            }
            return view('home');
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
