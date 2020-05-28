<?php

namespace App\Repositories;

use App\Models\Contact;
use App\User;
use App\Contracts\ContactInterface;
use Exception;

class ContactRepository implements ContactInterface
{

    protected $_contact;
    protected $_user;

    public function __construct()
    {
        $this->_contact = new Contact();
        $this->_user = new User();
    }
    /**
     * Get list
     * @author huynhtuvinh87@gmail.com
     */
    public function list($request)
    {
        try {
            $query = $this->_contact->select('*');
            if ($request->search) {
                $query = $query->where('name', 'LIKE', '%' . $request->search . '%');
                $query = $query->orWhere('email', 'LIKE', '%' . $request->search . '%');
                $query = $query->orWhere('phone', $request->search);
                $query = $query->orWhere('address', '%' . $request->search . '%');
            }
            return $query->orderBy('id', 'desc')->paginate($request->limit);
        } catch (Exception $e) {
            throw $e;
        }
    }


    /**
     * Create
     *
     * @author huynhtuvinh87@gmail.com
     */
    public function create($request)
    {
        try {
            $result = $this->_contact->create([
                'name' => $request->parent_id,
                'address' => $this->level($request->parent_id),
                'phone' => $request->title,
                'email' => $request->link,
                'content' => $request->content,
                'status' => $request->status
            ]);
            return $result;
        } catch (Exception $e) {
            throw $e;
        }
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
            $result = $this->_menu->where('id', $id)->delete();
            return $result;
        } catch (Exception $e) {
            throw $e;
        }
    }


    /**
     * Get view
     * @author huynhtuvinh87@gmail.com
     */
    public function find($id)
    {
        try {
            $query = $this->_menu->select('*')->where('id', $id)->first();
            return $query;
        } catch (Exception $e) {
            throw $e;
        }
    }
}
