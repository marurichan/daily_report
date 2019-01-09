<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class AuthenticateController extends Controller
{
    protected $users;

    public function __construct(User $users)
    {
        $this->users = $users;
    }

    public function slackAuth()
    {
        return Socialite::with('slack')->scopes([
            'identity.basic',
            'identity.email',
            'identity.avatar',
        ])->redirect();
    }

    public function userinfo()
    {
        if (array_key_exists('error', $_GET)) {
            return redirect('/');
        };

        $slackUserInfos = Socialite::with('slack')->user();
        $userInstance = $this->users->createUserInstance($slackUserInfos->id);

        if ($userInstance['deleted_at'] !== null) {
            $this->users->restoreDeletedUser($slackUserInfos->id);
        }
        $this->users->saveUserInfos($userInstance, $slackUserInfos);

        $loginUser = $this->users->where('slack_user_id', $slackUserInfos->id)->first();
        Auth::login($loginUser);
        return redirect('/');
    }

}

