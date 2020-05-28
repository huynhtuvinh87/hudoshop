<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\OrderRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Response;

class OrderController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(OrderRepository $orderRepository, UserRepository $userRepository)
    {
        $this->middleware('auth');
        $this->_orderRepository = $orderRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $result = $this->_orderRepository->list($request);
            return view('admin.order.index', ['orders' => $result, 'limit' => $request->limit]);
        } catch (Exception $e) {
            throw $e;
        }
    }
    public function invoice(Request $request)
    {
        try {
            $order = $this->_orderRepository->find($request->order_id);
            $result = $this->_orderRepository->invoice($request->order_id);
            return view('admin.order.invoice', ['invoices' => $result, 'order' => $order]);
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
            return view('admin.order.create');
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
                'name' => ['required', 'string', 'max:255', 'unique:orders'],
                'prefix' => ['required', 'string', 'max:255', 'unique:orders'],
            ]);

            $this->_orderRepository->create($request);
            return redirect()->route('admin.orders.index');
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
            $result = $this->_orderRepository->find($id);
            return view('admin.order.update', ['order' => $result]);
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
            $this->_orderRepository->update($id, $request);
            return redirect()->route('admin.orders.index');
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
            $this->_orderRepository->delete($id);
            return redirect()->route('admin.orders.index')->with('success', 'You have successfully delete!');
        } catch (Exception $e) {
            throw $e;
        }
    }
}
