<?php

namespace App\Repositories;

use App\Models\Maker;
use App\Contracts\MakerInterface;
use App\Models\Post;
use Exception;
use Illuminate\Support\Str;

class MakerRepository implements MakerInterface
{

    protected $_maker;
    protected $_post;

    public function __construct()
    {
        $this->_maker = new Maker();
        $this->_post = new Post();
    }
    /**
     * Get list Employee
     * @author huynhtuvinh87@gmail.com
     */
    public function list()
    {
        try {
            $maker = $this->_maker->select('id', 'name', 'slug')->get()->toArray();
            return $maker;
        } catch (Exception $e) {
            throw $e;
        }
    }


    /**
     * Create
     * @param $request
     * @author huynhtuvinh87@gmail.com
     */
    public function create($request)
    {
        try {
            $result = $this->_maker->create([
                'name' => $request->name,
                'slug' => Str::slug($request->name, '-'),
            ]);
            $this->storage();
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
    public function update($id, $request)
    {
        try {
            $result = $this->_maker->where('id', $id)->update([
                'name' => $request->name,
                'slug' => Str::slug($request->name, '-'),
            ]);
            $this->storage();
            return $this->_maker->where('id', $id)->first();
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
            $query = $this->_maker->select('*')->where('id', $id)->first();
            return $query;
        } catch (Exception $e) {
            throw $e;
        }
    }
    /**
     * Delete employees
     * @param string id
     *
     * @author huynhtuvinh87@gmail.com
     */
    public function delete($id)
    {
        try {
            $result = $this->_maker->where('id', $id)->delete();
            $this->storage();
            return $result;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function storage()
    {
        try {
            $makers = $this->_maker->select('id', 'slug', 'name')->get();
            $data = [];
            foreach ($makers as $value) {
                $data[$value->id] = $value;
            }
            \Storage::disk('local')->put('public/maker.json', json_encode($data));
        } catch (Exception $e) {
            throw $e;
        }
    }
}
