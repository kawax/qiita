<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /**
     * @return mixed
     */
    public function login()
    {
        return Socialite::driver('qiita')
                        ->scopes(['write_qiita'])
                        ->redirect();
    }

    /**
     * @param  Request  $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function callback(Request $request)
    {
        if (! $request->has('code')) {
            return redirect('/');
        }

        $loginUser = $this->user();

        auth()->login($loginUser, true);

        return redirect()->route('home');
    }

    /**
     * @return User
     */
    protected function user()
    {
        /**
         * @var \Laravel\Socialite\Two\User
         */
        $user = Socialite::driver('qiita')->user();

        return User::updateOrCreate(
            [
                'id' => $user->id,
            ],
            [
                'name'  => $user->name,
                'token' => $user->token,
            ]
        );
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout()
    {
        auth()->logout();

        return redirect('/');
    }
}
