<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ArticleRepository;
use Illuminate\Http\Response;

class AjaxController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ArticleRepository $articleRespository)
    {
        $this->middleware('auth');
        $this->_articleRespository = $articleRespository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function upload(Request $request)
    {
        try {

            return response()->json(['meta' => ['code' => Response::HTTP_OK, 'message' => 'OK'], 'result' => $this->_articleRespository->upload($request->file)], Response::HTTP_OK);
        } catch (Exception $e) {
            throw $e;
        }
    }
}
