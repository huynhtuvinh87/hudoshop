<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->middleware('auth');
        $this->_userRepository = $userRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function me()
    {
        return view('front.user.me', ['user' => \Auth::user()]);
    }

    public function update(Request $request)
    {
        try {
            $v = [
                'name' => ['required', 'string', 'max:255'],
                'email' => 'required|string|max:255|unique:users,email,' . \Auth::user()->id,

            ];
            if ($request->check_password) {
                $v = array_merge($v, ['password' => ['required', 'string', 'min:6', 'confirmed']]);
            }
            $this->validate(
                $request,
                $v
            );
            $this->_userRepository->updateMember(\Auth::user()->id, $request);
            return redirect()->route('me');
        } catch (Exception $e) {
            throw $e;
        }
    }
}
