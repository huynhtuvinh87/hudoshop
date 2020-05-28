<?php

namespace App\Repositories;

use App\Models\Invoice;
use App\Models\PostSection;
use App\Contracts\InvoiceInterface;
use Exception;

class InvoiceRepository implements InvoiceInterface
{

    protected $_invoice;

    public function __construct()
    {
        $this->_invoice = new Invoice();
    }
    /**
     * Get list
     * @author huynhtuvinh87@gmail.com
     */
    public function list()
    {
        try {
            return $this->_invoice->select('*')->paginate();
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
            $result = $this->_invoice->create($data);
            return $result;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Update
     * @param $request
     *
     * @author huynhtuvinh87@gmail.com
     */
    public function update($id, $data)
    {
        try {
            $result = $this->_section->where('id', $id)->update([
                'name' => $data->name,
                'order' => $data->order
            ]);
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
            $query = $this->_section->select('*')->where('id', $id)->first();
            return $query;
        } catch (Exception $e) {
            throw $e;
        }
    }
}
