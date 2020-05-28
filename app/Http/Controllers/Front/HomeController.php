<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Repositories\ArticleRepository;
use App\Repositories\CategoryRepository;
use Image;

class HomeController extends Controller
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
    public function index()
    {
        return view('front.home.index');
    }

    public function resize($path)
    {
        $image = Image::make(public_path($path));
        $width = $image->width();
        $height = $image->height();
        $new_width = $new_height = 200;
        if ($width > $height) {
            $thumb_w    =   $new_width;
            $thumb_h    =   $height * ($new_height / $width);
        }

        if ($width < $height) {
            $thumb_w    =   $width * ($new_width / $height);
            $thumb_h    =   $new_height;
        }

        if ($width == $height) {
            $thumb_w    =   $new_width;
            $thumb_h    =   $new_height;
        }
        $arr = explode('/', $path);
        $name = $arr[count($arr) - 1];
        if (\Storage::disk('local')->get($path)) {
            return url('storage/images/' . $name);
        }

        $image->resize($thumb_w, $thumb_h)->save(storage_path('app/public/images/' . $name));
        return url('storage/images/' . $name);
    }
}
