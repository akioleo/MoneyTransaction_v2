<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $user = $request->user();
        if (strlen($user['document']) > 11){
            $user['account_type'] = 1;
            $user->save();
        }
        $userType = ($user['account_type']);
        $balance = ($user['balance']);
        return view('index', [
            'type' => $userType,
            'balance' => $balance
            ]);
    }

    public function transfer(Request $request)
    {
        $extract = auth()->user()->balance;
        return view('transfer', [
            'balance' => $extract
            ]);
    }

    public function store (Request $request)
    {
        dd($request->only('name'));
    }
}
