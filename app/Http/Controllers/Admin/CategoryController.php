<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\CategoryRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Response;

class CategoryController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(CategoryRepository $categoryRepository, UserRepository $userRepository)
    {
        $this->middleware('auth');
        $this->_categoryRepository = $categoryRepository;
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
            $parents = $this->_categoryRepository->getParent();
            $query = $this->_categoryRepository->list();
            return view('admin.category.index', ['categories' => $query, 'parents' => $parents]);
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
            $query = $this->_categoryRepository->listTrash();
            return view('admin.category.trash', ['categories' => $query]);
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
            $parents = $this->_categoryRepository->getParent();
            return view('admin.category.create', ['parents' => $parents]);
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
                'title' => ['required', 'string', 'max:255', 'unique:categories'],
            ]);

            $this->_categoryRepository->create($request);
            return redirect()->route('admin.categories.index');
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
            $result = $this->_categoryRepository->find($id);
            $parents = $this->_categoryRepository->getParent($id);
            return view('admin.category.update', ['category' => $result, 'parents' => $parents]);
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
                'title' => 'required|string|unique:categories,title,' . $id,
            ]);
            $this->_categoryRepository->update($id, $request);
            return redirect()->route('admin.categories.index');
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

            $result = $this->_categoryRepository->rolback($id);

            return redirect()->route('admin.categories.trash.list');
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

            $result = $this->_categoryRepository->trash($id);

            return redirect()->route('admin.categories.index');
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
            $result = $this->_categoryRepository->delete($id);
            return redirect()->route('admin.categories.index');
        } catch (Exception $e) {
            throw $e;
        }
    }
}
