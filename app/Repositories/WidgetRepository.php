<?php

namespace App\Repositories;

use App\Models\Widget;
use App\Models\WidgetItem;
use App\Contracts\WidgetInterface;
use App\Models\Post;
use Exception;

class WidgetRepository implements WidgetInterface
{

    protected $_widget;
    protected $_widgetItem;
    protected $_post;

    public function __construct()
    {
        $this->_widget = new Widget();
        $this->_widgetItem = new WidgetItem();
        $this->_post = new Post();
    }
    /**
     * Get list Employee
     * @author huynhtuvinh87@gmail.com
     */
    public function list()
    {
        try {
            $widget = $this->_widget->select('id', 'prefix', 'name')->get()->toArray();
            return $widget;
        } catch (Exception $e) {
            throw $e;
        }
    }


    /**
     * Create Employee
     *
     * @author huynhtuvinh87@gmail.com
     */
    public function create($data)
    {
        try {
            $result = $this->_widget->create($data);
            return $result;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Create Employee
     *
     * @author huynhtuvinh87@gmail.com
     */
    public function createPost($data)
    {
        try {
            $result = $this->_post->create($data);
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
            $query = $this->_widget->select('*')->where('id', $id)->first();
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
            $result = $this->_widget->where('id', $id)->delete();
            $this->_widgetItem->where('widget_id', $id)->delete();
            return $result;
        } catch (Exception $e) {
            throw $e;
        }
    }
}
