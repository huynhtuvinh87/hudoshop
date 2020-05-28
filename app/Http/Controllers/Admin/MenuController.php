<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\MenuRepository;
use App\Repositories\MenuItemRepository;
use App\Repositories\UserRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\PageRepository;

class MenuController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        MenuRepository $menuRepository,
        MenuItemRepository $menuItemRepository,
        UserRepository $userRepository,
        CategoryRepository $categoryRepository,
        PageRepository $pageRepository
    ) {
        $this->middleware('auth');
        $this->_menuRepository = $menuRepository;
        $this->_menuItemRepository = $menuItemRepository;
        $this->_userRepository = $userRepository;
        $this->_categoryRepository = $categoryRepository;
        $this->_pageRepository = $pageRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $getMenu = $this->_menuRepository->list();
            $query = $this->_menuItemRepository->list($request->menu_id ? $request->menu_id : $getMenu[0]['id']);
            $parents = $this->_menuItemRepository->getParent($request->menu_id ? $request->menu_id : $getMenu[0]['id']);
            $category = $this->_categoryRepository->getParent();
            $page = $this->_pageRepository->toArray();
            return view('admin.menu.index', ['menus' => $query, 'parents' => $parents, 'getMenu' => $getMenu, 'category' => $category, 'page' => $page, 'menu_id' => $request->menu_id]);
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
            $parents = $this->_menuRepository->getParent();
            return view('admin.menu.create', ['parents' => $parents]);
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
            $v = [];
            $data = [];

            if ($request->type == config('global.menu_type.category')) {
                $this->validate($request, array_merge($v, [
                    'category_id' => ['required']
                ]));
                foreach ($request->category_id as $id) {
                    $this->_menuItemRepository->create([
                        'parent_id' => $request->parent_id,
                        'level' => $this->_menuItemRepository->level($request->parent_id),
                        'menu_id' => $request->menu_id,
                        'link' => $request->{'category_url_' . $id},
                        'title' => $request->{'category_title_' . $id},
                        'type' => config('global.menu_type.category'),
                        'type_id' => $id
                    ]);
                }
            } elseif ($request->type == config('global.menu_type.custom_url')) {
                $this->validate($request, array_merge($v, [
                    'title' => ['required', 'string', 'max:255', 'unique:menus'],
                    'link' => ['required', 'string', 'url', 'max:255'],
                ]));
                $this->_menuItemRepository->create([
                    'parent_id' => $request->parent_id,
                    'level' => $this->_menuItemRepository->level($request->parent_id),
                    'menu_id' => $request->menu_id,
                    'link' => $request->link,
                    'title' => $request->title,
                    'type' => config('global.menu_type.custom_url'),
                    'type_id' => $id
                ]);
            } else {
                $this->validate($request, array_merge($v, [
                    'page_id' => ['required']
                ]));
                foreach ($request->page_id as $id) {
                    $this->_menuItemRepository->create([
                        'parent_id' => $request->parent_id,
                        'level' => $this->_menuItemRepository->level($request->parent_id),
                        'menu_id' => $request->menu_id,
                        'link' => $request->{'page_url_' . $id},
                        'title' => $request->{'page_title_' . $id},
                        'type' => config('global.menu_type.page'),
                        'type_id' => $id
                    ]);
                }
            }
            return redirect()->route('admin.menus.index', ['menu_id' => $request->menu_id]);
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
            $result = $this->_menuItemRepository->find($id);
            $parents = $this->_menuItemRepository->getParent($id);
            return view('admin.menu.update', ['menu' => $result, 'parents' => $parents]);
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
                'link' => ['required', 'string', 'url', 'max:255'],
            ]);
            $this->_menuItemRepository->update($id, $request);
            return redirect()->route('admin.menus.index');
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
        try {
            $result = $this->_menuItemRepository->find($id);
            $this->_menuItemRepository->delete($id);
            return redirect()->route('admin.menus.index', ['menu_id' => $result->menu_id])->with('success', 'You have successfully delete!');
        } catch (Exception $e) {
            throw $e;
        }
    }
    public function actions(Request $request)
    {
        try {
            if ($request->submit == "apply") {
                return redirect()->route('admin.menus.index', ['menu_id' => $request->menu_id]);
            } elseif ($request->submit == "add") {
                $this->_menuRepository->create($request->menu_name);
            } else {
                $this->_menuRepository->delete($request->menu_id);
            }
            return redirect()->route('admin.menus.index');
        } catch (Exception $e) {
            throw $e;
        }
    }
    public function order(Request $request)
    {
        try {
            $this->_menuItemRepository->updateOrder($request);
        } catch (Exception $e) {
            throw $e;
        }
    }
}
