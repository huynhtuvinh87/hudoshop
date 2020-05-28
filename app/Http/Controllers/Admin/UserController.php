<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;

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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {

            $result = $this->_userRepository->list($request);
            return view('admin.user.index', ['users' => $result, 'limit' => $request->limit]);
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash(Request $request)
    {
        $request->status = 3;
        try {

            $result = $this->_userRepository->list($request);
            return view('admin.user.trash', ['users' => $result, 'limit' => $request->limit]);
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            return view('admin.user.create');
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        $result = $this->_userRepository->register($request);
        return redirect()->route('admin.users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $result = $this->_userRepository->find($id);
            return view('admin.user.update', ['user' => $result]);
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        try {
            $v = [
                'name' => ['required', 'string', 'max:255'],
                'username' => 'required|string|max:20|unique:users,username,' . $id,
                'email' => 'required|string|max:255|unique:users,email,' . $id,

            ];
            if ($request->check_password) {
                $v = array_merge($v, ['password' => ['required', 'string', 'min:6', 'confirmed']]);
            }
            $this->validate(
                $request,
                $v
            );
            $this->_userRepository->update($id, $request);
            return redirect()->route('admin.users.index');
        } catch (Exception $e) {
            throw $e;
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function me()
    {
        try {
            $result = $this->_userRepository->find(Auth::user()->id);
            return view('admin.user.update', ['user' => $result]);
        } catch (Exception $e) {
            throw $e;
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function trash_destroy($id)
    {
        try {

            $result = $this->_userRepository->trash($id);

            return redirect()->route('admin.users.index');
        } catch (Exception $e) {
            throw $e;
        }
        //
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $result = $this->_userRepository->destroy($id);
            return redirect()->route('admin.users.index');
        } catch (Exception $e) {
            throw $e;
        }
        //
    }
}
