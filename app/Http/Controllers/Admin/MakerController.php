<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\MakerRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Response;

class makerController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(MakerRepository $makerRepository, UserRepository $userRepository)
    {
        $this->middleware('auth');
        $this->_makerRepository = $makerRepository;
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
            $query = $this->_makerRepository->list();
            return view('admin.maker.index', ['makers' => $query]);
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
            $query = $this->_makerRepository->listTrash();
            return view('admin.maker.trash', ['makers' => $query]);
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
            $parents = $this->_makerRepository->getParent();
            return view('admin.maker.create', ['parents' => $parents]);
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
                'name' => ['required', 'string', 'max:255', 'unique:makers'],
            ]);

            $this->_makerRepository->create($request);
            return redirect()->route('admin.makers.index');
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
            $result = $this->_makerRepository->find($id);
            return view('admin.maker.update', ['maker' => $result]);
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
                'name' => 'required|string|max:50|unique:makers,name,' . $id,
            ]);
            $this->_makerRepository->update($id, $request);
            return redirect()->route('admin.makers.index');
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
    public function rolback($id)
    {
        try {

            $result = $this->_makerRepository->rolback($id);

            return redirect()->route('admin.makers.trash.list');
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
    public function trash($id)
    {
        try {

            $result = $this->_makerRepository->trash($id);

            return redirect()->route('admin.makers.index');
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

            $result = $this->_makerRepository->delete($id);
            return redirect()->route('admin.makers.index');
        } catch (Exception $e) {
            throw $e;
        }
    }
}
