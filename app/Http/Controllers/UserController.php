<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    public $users;

    public function __construct(User $users)
    {
        $this->middleware('auth');
        $this->users = $users;
    }

    public function index()
    {
        $userId = Auth::id();
        $userInfos = $this->users->find($userId);
        return view('index', compact('userInfos'));
    }

}

