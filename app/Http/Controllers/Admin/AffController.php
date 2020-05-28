<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\CategoryRepository;
use App\Repositories\UserRepository;
use App\Repositories\AffRepository;

class AffController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepository $userRepository, AffRepository $affRespository)
    {
        $this->middleware('auth');
        $this->_userRepository = $userRepository;
        $this->_affRespository = $affRespository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $result = $this->_affRespository->list($request);
            return view('admin.aff.index', ['affs' => $result, 'limit' => $request->limit]);
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listTrash(Request $request)
    {
        try {
            $query = $this->_affRespository->listTrash($request);
            return view('admin.aff.trash', ['affs' => $query, 'limit' => $request->limit]);
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
            return view('admin.aff.create');
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
        try {
            $this->validate($request, [
                'title' => ['required', 'string', 'max:255'],
                'content' => ['required', 'string', 'max:255'],
            ]);

            $this->_affRespository->create($request);
            return redirect()->route('admin.affs.index');
        } catch (Exception $e) {
            throw $e;
        }
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
            $result = $this->_affRespository->find($id);
            return view('admin.aff.update', ['aff' => $result]);
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
            $this->validate($request, [
                'title' => ['required', 'string', 'max:255'],
                'content' => ['required', 'string', 'max:255'],
            ]);
            $this->_affRespository->update($id, $request);
            return redirect()->route('admin.affs.index');
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
    public function destroy($id)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function trash($id)
    {
        try {
            $this->_affRespository->trash($id);
            return redirect()->route('admin.affs.index')->with('success', 'You have successfully trash!');
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
    public function rolback($id)
    {
        try {
            $this->_affRespository->rolback($id);
            return redirect()->route('admin.affs.trash.list')->with('success', 'You have successfully rolback!');
        } catch (Exception $e) {
            throw $e;
        }
        //
    }
}
