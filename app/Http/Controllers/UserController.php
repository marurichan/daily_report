<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Requests\UpdateUserRequest;

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

    public function update(UpdateUserRequest $request)
    {
        $userId = Auth::id();
        $input = $request->all();
        $this->userInfosModel->updateUserInfoCheckColumn($input, $userId);//名前変更

        return redirect()->route('home');
    }

}

