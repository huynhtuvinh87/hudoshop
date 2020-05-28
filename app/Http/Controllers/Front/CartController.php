<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Repositories\ArticleRepository;
use App\Repositories\InvoiceRepository;
use App\Repositories\OrderRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Cart;

class CartController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        ArticleRepository $articleRespository,
        OrderRepository $orderRepository,
        InvoiceRepository $invoiceRepository
    ) {
        $this->_articleRespository = $articleRespository;
        $this->_orderRepository = $orderRepository;
        $this->_invoiceRepository = $invoiceRepository;
    }

    public function checkout()
    {
        try {
            $payment = $this->_orderRepository->payment();
            return view('front.cart.checkout', ['data' => Cart::getContent(), 'payment' => $payment]);
        } catch (Exception $e) {
            throw $e;
        }
    }
    public function add(Request $request)
    {
        try {
            $product = $this->_articleRespository->find($request->id);
            Cart::add(array(
                'id' => $product->id,
                'name' => $product->title,
                'price' => $product->price,
                'quantity' => $request->qty,
                'attributes' => [
                    'image' => $product->image,
                    'url' => $product->slug . '-' . $product->id,
                ]
            ));


            return response()->json(['meta' => ['code' => Response::HTTP_OK, 'message' => 'OK'], 'result' => Cart::getTotalQuantity()], Response::HTTP_OK);
        } catch (Exception $e) {
            throw $e;
        }
    }
    public function update(Request $request)
    {
        try {
            Cart::update($request->id, array(
                'quantity' => array(
                    'relative' => false,
                    'value' => $request->qty
                ),
            ));

            return response()->json(['meta' => ['code' => Response::HTTP_OK, 'message' => 'OK'], 'result' => Cart::getTotalQuantity()], Response::HTTP_OK);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function remove(Request $request)
    {
        try {
            Cart::remove($request->id);
            return response()->json(['meta' => ['code' => Response::HTTP_OK, 'message' => 'OK'], 'result' => Cart::getTotalQuantity()], Response::HTTP_OK);
        } catch (Exception $e) {
            throw $e;
        }
    }
    public function order(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email',
                'phone' => 'required|string',
                'address' => 'required',
                'payment' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json(['meta' => ['code' => 401, 'error' => $validator->errors()]], 401);
            }
            $order = $this->_orderRepository->create($request);
            foreach (Cart::getContent() as $value) {
                $this->_invoiceRepository->create([
                    'order_id' => $order->id,
                    'product_id' => $value->id,
                    'quantity' => $value->quantity,
                    'price' => $value->price
                ]);
            }
            Cart::clear();
            session()->put('order_success', 'Đặt hàng thành công!');
            return response()->json(['meta' => ['code' => Response::HTTP_OK, 'message' => 'OK'], 'result' => $order->code], Response::HTTP_OK);
        } catch (Exception $e) {
            throw $e;
        }
    }
    public function success()
    {
        if (!session()->has('order_success')) {
            return redirect('/');
        }
        session()->forget('order_success');
        return view('front.cart.order_success');
    }
}
