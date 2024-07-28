<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontEndController extends Controller
{
    public function index(){
        return view('home');
    }
    public function journal(){
        return view('addjournal');
    }
    public function login(){
        if(checkLogin()){
            return redirect('/');
        }
        return view('login');
    }
    public function signup(){
        if(checkLogin()){
            return redirect('/');
        }
        return view('signup');
    }
}
