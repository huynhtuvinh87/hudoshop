<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Repositories\ArticleRepository;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Cart;

class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ArticleRepository $articleRespository, CategoryRepository $categoryRespository)
    {
        $this->_articleRespository = $articleRespository;
        $this->_categoryRespository = $categoryRespository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function filter(Request $request)
    {
        try {
            $result = $this->_articleRespository->search($request);
            return view('front.product.filter', ['data' => $result]);
        } catch (Exception $e) {
            throw $e;
        }
    }
    public function category(Request $request)
    {
        $result = $this->_articleRespository->getByCategory($request->slug);
        $category = $this->_categoryRespository->findBySlug($request->slug);
        return view('front.product.category', ['data' => $result, 'category' => $category]);
        try {
        } catch (Exception $e) {
            throw $e;
        }
    }
    public function detail(Request $request)
    {

        try {
            $result = $this->_articleRespository->find($request->id);

            if ($result->images) {
                $result->images = explode(',', $result->images);
            }
            return view('front.product.detail', ['data' => $result]);
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getLink(Request $request)
    {
        try {

            $r = $this->_articleRespository->findByCode($request->code);
            return redirect(url($r->slug . '-' . $r->id));
        } catch (Exception $e) {
            throw $e;
        }
    }
}
