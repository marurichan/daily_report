<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public $users;

    /**
     * UserController constructor.
     * @param User $users
     */
    public function __construct(User $users)
    {
        $this->middleware('auth');
        $this->users = $users;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $userId = Auth::id();
        $userInfos = $this->users->find($userId);
        return view('user.home.index', compact('userInfos'));
    }
}

