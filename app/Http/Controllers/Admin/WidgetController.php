<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\WidgetRepository;
use App\Repositories\WidgetItemRepository;
use App\Repositories\UserRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\PageRepository;

class WidgetController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        WidgetRepository $widgetRepository,
        WidgetItemRepository $widgetItemRepository,
        UserRepository $userRepository,
        CategoryRepository $categoryRepository,
        PageRepository $pageRepository
    ) {
        $this->middleware('auth');
        $this->_widgetRepository = $widgetRepository;
        $this->_widgetItemRepository = $widgetItemRepository;
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
            $this->_widgetItemRepository->storage();
            $getwidget = $this->_widgetRepository->list();
            $query = null;
            $findWidget = null;
            if ($getwidget) {
                $query = $this->_widgetItemRepository->list($request->widget_id ? $request->widget_id : $getwidget[0]['id']);
                $findWidget = $getwidget[array_search($request->widget_id ? $request->widget_id : $getwidget[0]['id'], array_column($getwidget, 'id'))];
            }

            $category = $this->_categoryRepository->getParent();
            $page = $this->_pageRepository->toArray();
            return view('admin.widget.index', ['widgets' => $query, 'getwidget' => $getwidget, 'category' => $category, 'page' => $page, 'findWidget' => $findWidget]);
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
            return view('admin.widget.create');
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

            if ($request->submit == "add") {
                $this->validate($request, array_merge($v, [
                    'prefix' => ['required'],
                    'name' => ['required']
                ]));
                $widget = $this->_widgetRepository->create([
                    'prefix' => $request->prefix,
                    'name' => $request->name,
                    'type' => $request->type
                ]);
            } else {
                $widget = $this->_widgetRepository->find($request->widget_id);
            }
            $post_id = array_pluck($this->_widgetItemRepository->getPostByWidget($request->widget_id), 'post_id');
            if ($request->type == config('global.widget_type.category')) {
                $this->validate($request, array_merge($v, [
                    'category_id' => ['required']
                ]));
                if ($request->post_limit > 0) {
                    foreach ($this->_categoryRepository->getPostInCategory($request->category_id, $request->post_limit) as $post) {
                        if (!in_array($post_id['post_id'], $post_id)) {
                            $this->_widgetItemRepository->create([
                                'widget_id' => $widget->id,
                                'post_id' => $post['post_id']
                            ]);
                        }
                    }
                }
            } elseif ($request->type == config('global.widget_type.html_text')) {
                $this->validate($request, array_merge($v, [
                    'content' => ['required'],
                ]));
                $post = $this->_widgetRepository->createPost([
                    'title' => $widget->name,
                    'slug' => $widget->prefix,
                    'content' => $request->content,
                    'type' => 'widget',
                    'user_id' => \Auth::user()->id,
                    'status' => config('global.status.active')
                ]);
                $this->_widgetItemRepository->create([
                    'widget_id' => $widget->id,
                    'post_id' => $post->id
                ]);
            } else {
                $this->validate($request, array_merge($v, [
                    'page_id' => ['required']
                ]));
                foreach ($request->page_id as $id) {
                    if (!in_array($id, $post_id)) {
                        $this->_widgetItemRepository->create([
                            'widget_id' => $widget->id,
                            'post_id' => $id
                        ]);
                    }
                }
            }
            $this->_widgetItemRepository->storage();
            return redirect()->route('admin.widgets.index', ['widget_id' => $widget->id]);
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
            $result = $this->_widgetItemRepository->find($id);
            return view('admin.widget.update', ['widget' => $result]);
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
            ]);
            $result = $this->_widgetItemRepository->find($id);
            $this->_widgetItemRepository->update($result->post_id, $request);
            return redirect()->route('admin.widgets.index', ['widget_id' => $result->widget_id]);
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
            $result = $this->_widgetItemRepository->find($id);
            $this->_widgetItemRepository->delete($id);
            return redirect()->route('admin.widgets.index', ['widget_id' => $result['widget_id']])->with('success', 'You have successfully delete!');
        } catch (Exception $e) {
            throw $e;
        }
    }
    public function actions(Request $request)
    {
        if ($request->submit == "apply") {
            return redirect()->route('admin.widgets.index', ['widget_id' => $request->widget_id]);
        } else {
            $this->_widgetRepository->delete($request->widget_id);
            $this->_widgetItemRepository->storage();
            return redirect()->route('admin.widgets.index');
        }
    }
}
