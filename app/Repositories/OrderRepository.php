<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\Invoice;
use App\Contracts\OrderInterface;
use Exception;

class OrderRepository implements OrderInterface
{

    protected $_order;
    protected $_invoice;

    public function __construct()
    {

        $this->_order = new Order();
        $this->_invoice = new Invoice();
    }
    /**
     * Get list
     * @author huynhtuvinh87@gmail.com
     */
    public function list($request)
    {
        try {
            $query = $this->_order->select('*');
            if ($request->search) {
                $query = $query->where('fullname', 'LIKE', '%' . $request->search . '%');
                $query = $query->orWhere('phone', 'LIKE', '%' . $request->search . '%');
                $query = $query->orWhere('address', 'LIKE', '%' . $request->search . '%');
                $query = $query->orWhere('code', 'LIKE', '%' . $request->search . '%');
            }
            return $query->orderBy('created_at', 'desc')->paginate($request->limit);
        } catch (Exception $e) {
            throw $e;
        }
    }


    /**
     * Create
     *
     * @author huynhtuvinh87@gmail.com
     */
    public function create($data)
    {
        try {
            $result = $this->_order->create([
                'code' => str_pad($this->max(), 10, "0", STR_PAD_LEFT),
                'fullname' => $data->name,
                'phone' => $data->phone,
                'email' => $data->email,
                'address' => $data->address,
                'province' => $data->province,
                'price' => \Cart::getTotal() + 20000,
                'payment' => $data->payment,
                'status' => 1
            ]);
            return $result;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Update article
     * @param $id
     * @param string title
     * @param string content
     * @param string image
     * @param string images
     * @param string status
     *
     * @author huynhtuvinh87@gmail.com
     */
    public function update($id, $request)
    {
        try {

            $result = $this->_order->where('id', $id)->update(['status' => $request->status]);

            return $result;
        } catch (Exception $e) {
            throw $e;
        }
    }
    public function max()
    {
        try {
            $result = $this->_order->max('id');
            if (!$result) {
                return 1;
            }
            return $result;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Get find category
     * @param $id
     * @author huynhtuvinh87@gmail.com
     */
    public function find($id)
    {
        try {
            $query = $this->_order->select('*')->where('id', $id)->first();
            return $query;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Get find category
     * @param $id
     * @author huynhtuvinh87@gmail.com
     */
    public function invoice($id)
    {
        try {
            $query = $this->_invoice->select('invoices.price', 'invoices.quantity', 'posts.title', 'posts.slug', 'posts.id', 'posts.image')->leftjoin('posts', function ($q) {
                $q->on('posts.id', 'invoices.product_id');
            })->where('order_id', $id)->get();
            return $query;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function payment()
    {
        $payment = [];
        if (\Constant::setting()->payment) {
            foreach (explode(',', \Constant::setting()->payment) as $value) {
                $value = explode(':', $value);
                $payment[$value[0]] = $value[1];
            }
        }
        return $payment;
    }

    /**
     * Delete
     * @param string id
     *
     * @author huynhtuvinh87@gmail.com
     */
    public function delete($id)
    {
        try {
            $result = $this->_order->where('id', $id)->delete();
            $this->_invoice->where('order_id', $id)->delete();
            return $result;
        } catch (Exception $e) {
            throw $e;
        }
    }
}
