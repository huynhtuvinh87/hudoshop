<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Repositories\PageRepository;
use App\Repositories\AffRepository;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(PageRepository $pageRepository, AffRepository $affRepository)
    {
        $this->_pageRepository = $pageRepository;
        $this->_affRepository = $affRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function view(Request $request)
    {
        try {
            $page = $this->_pageRepository->find($request->id);
            return view('front.page.view', ['page' => $page]);
        } catch (Exception $e) {
            throw $e;
        }
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function viewAfl(Request $request)
    {
        try {
            $page = $this->_pageRepository->find($request->id);
            return view('front.page.view_afl', ['page' => $page]);
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
            $aff = $this->_affRepository->findByCode($request->code);
            return redirect(url('a/' . $aff->slug . '-' . $aff->id));
        } catch (Exception $e) {
            throw $e;
        }
    }
}
