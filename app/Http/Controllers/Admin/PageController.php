<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\CategoryRepository;
use App\Repositories\UserRepository;
use App\Repositories\PageRepository;

class PageController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(CategoryRepository $categoryRepository, UserRepository $userRepository, PageRepository $pageRespository)
    {
        $this->middleware('auth');
        $this->_categoryRepository = $categoryRepository;
        $this->_userRepository = $userRepository;
        $this->_pageRespository = $pageRespository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $result = $this->_pageRespository->list($request);
            return view('admin.page.index', ['pages' => $result, 'limit' => $request->limit]);
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
            $query = $this->_pageRespository->listTrash($request);
            return view('admin.page.trash', ['pages' => $query, 'limit' => $request->limit]);
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
            $category = $this->_categoryRepository->getParent();
            return view('admin.page.create', ['category' => $category]);
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
            ]);

            $this->_pageRespository->create($request);
            return redirect()->route('admin.pages.index');
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
            $result = $this->_pageRespository->find($id);
            return view('admin.page.update', ['page' => $result]);
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
            $this->_pageRespository->update($id, $request);
            return redirect()->route('admin.pages.index');
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
            $this->_pageRespository->trash($id);
            return redirect()->route('admin.pages.index')->with('success', 'You have successfully trash!');
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
            $this->_pageRespository->rolback($id);
            return redirect()->route('admin.pages.trash.list')->with('success', 'You have successfully rolback!');
        } catch (Exception $e) {
            throw $e;
        }
        //
    }
}
