<?php

namespace App\Repositories;

use App\Models\Widget;
use App\Models\WidgetItem;
use App\Models\Post;
use App\Contracts\WidgetItemInterface;
use Exception;
use Redis;

class WidgetItemRepository implements WidgetItemInterface
{

    protected $_widget;
    protected $_widgetItem;
    public function __construct()
    {
        $this->_widget = new Widget();
        $this->_widgetItem = new WidgetItem();
        $this->_article = new Post();
    }

    /**
     * Get list Employee
     * @author huynhtuvinh87@gmail.com
     */
    public function list($widget_id, $limit = null)
    {
        try {
            $widget = $this->_widgetItem->select('posts.*', 'widget_items.*')
                ->leftjoin('posts', function ($q) {
                    $q->on('posts.id', 'widget_items.post_id');
                })
                ->where('posts.status', '!=', config('global.status.trash'));
            if ($limit) {
                $widget = $widget->limit($limit);
            }
            $widget = $widget->where('widget_id', $widget_id)->get()->toArray();
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
            $result = $this->_widgetItem->create($data);
            $this->storage();
            return $result;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function update($id, $request)
    {
        try {
            $data = [
                'title' => $request->title,
                'content' => $request->content
            ];
            $result = $this->_article->where('id', $id)->update($data);
            $this->storage();
            return $result;
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
            $result = $this->_widgetItem->select('posts.*')->leftjoin('posts', function ($q) {
                $q->on('posts.id', 'widget_items.post_id');
            })->where('widget_items.id', $id)->first();
            if ($result->type == "widget") {
                $this->_article->where('id', $result->id)->delete();
            }
            $this->_widgetItem->where('id', $id)->delete();
            $this->storage();
            return $result;
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
    public function getPostByWidget($wid)
    {
        try {
            $result = $this->_widgetItem->select('post_id')->where('widget_id', $wid)->get()->toArray();
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
            $query = $this->_widgetItem->select('posts.*', 'widget_items.*')->where('widget_items.id', $id)->leftjoin('posts', function ($q) {
                $q->on('posts.id', 'widget_items.post_id');
            })->first();
            return $query;
        } catch (Exception $e) {
            throw $e;
        }
    }
    public function storage()
    {
        $widget = $this->_widgetItem->select(
            'post_id as id',
            'widget_id',
            'widgets.prefix',
            'posts.type',
            'title',
            'slug',
            'image',
            'price',
            'price_sale',
            \DB::raw('(CASE WHEN posts.type = "widget" THEN posts.content ELSE "" END) AS content')
        )->leftjoin('posts', function ($q) {
            $q->on('posts.id', 'widget_items.post_id');
        })->leftjoin('widgets', function ($q) {
            $q->on('widgets.id', 'widget_items.widget_id');
        })->get()->toArray();
        $data = [];
        foreach ($widget as $key => $value) {
            $data[$value['prefix']][] = $value;
        }
        \Storage::disk('local')->put('public/widget.json', json_encode($data));
    }
}
