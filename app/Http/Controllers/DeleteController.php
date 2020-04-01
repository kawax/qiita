<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DeleteController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(Request $request, string $id)
    {
        $res = Http::qiita($request->user()->token)
                   ->delete('items/'.$id);

        if ($res->serverError()) {
            dd($res->body());
        }

        return redirect()->route('home');
    }
}
