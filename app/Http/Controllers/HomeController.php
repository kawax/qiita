<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @param  Request  $request
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $items = Http::qiita($request->user()->token)
                     ->get(
                         'authenticated_user/items',
                         [
                             'per_page' => 100,
                         ]
                     )->json();

        return view('home')->with(compact('items'));
    }
}
