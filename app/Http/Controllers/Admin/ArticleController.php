<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\CategoryRepository;
use App\Repositories\UserRepository;
use App\Repositories\ArticleRepository;
use App\Repositories\MakerRepository;

class ArticleController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        CategoryRepository $categoryRepository,
        UserRepository $userRepository,
        ArticleRepository $articleRepository,
        MakerRepository $makerRepository
    ) {
        $this->middleware('auth');
        $this->_categoryRepository = $categoryRepository;
        $this->_userRepository = $userRepository;
        $this->_articleRepository = $articleRepository;
        $this->_makerRepository = $makerRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $result = $this->_articleRepository->list($request);
            return view('admin.article.index', ['articles' => $result, 'limit' => $request->limit]);
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
            $query = $this->_articleRepository->listTrash($request);
            return view('admin.article.trash', ['articles' => $query, 'limit' => $request->limit]);
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
            $maker = $this->_makerRepository->list();
            $category = $this->_categoryRepository->getParent();
            return view('admin.article.create', ['category' => $category, 'maker' => $maker]);
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
                'price' => ['required']
            ]);

            $this->_articleRepository->create($request);
            return redirect()->route('admin.articles.index');
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
            $maker = $this->_makerRepository->list();
            $postCategory = array_pluck($this->_articleRepository->postCategory($id), 'category_id');
            $category = $this->_categoryRepository->getParent();
            $result = $this->_articleRepository->find($id);
            $result->images = $result->images ? explode(',', $result->images) : null;
            return view('admin.article.update', ['article' => $result, 'category' => $category, 'postCategory' => $postCategory, 'maker' => $maker]);
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
            $this->_articleRepository->update($id, $request);
            return redirect()->route('admin.articles.index');
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
            $this->_articleRepository->trash($id);
            return redirect()->route('admin.articles.index')->with('success', 'You have successfully trash!');
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
            $this->_articleRepository->rolback($id);
            return redirect()->route('admin.articles.trash.list')->with('success', 'You have successfully rolback!');
        } catch (Exception $e) {
            throw $e;
        }
        //
    }
}
