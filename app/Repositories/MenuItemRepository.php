<?php

namespace App\Repositories;

use App\Models\Menu;
use App\Models\MenuItem;
use App\User;
use App\Contracts\MenuItemInterface;
use Exception;
use Storage;

class MenuItemRepository implements MenuItemInterface
{

    protected $_menu;
    protected $_menuItem;
    protected $_user;

    public function __construct()
    {
        $this->_menu = new Menu();
        $this->_menuItem = new MenuItem();
        $this->_user = new User();
    }
    /**
     * Get list Employee
     * @author huynhtuvinh87@gmail.com
     */
    public function list($menu_id)
    {
        try {
            $data = [];
            $menu = $this->_menuItem->select('id', 'parent_id', 'order', 'title', 'link', 'level')->where('parent_id', null)->where('menu_id', $menu_id)->orderBy('order', 'asc')->get();
            if ($menu) {
                foreach ($menu as $key => $value) {
                    $children2 = [];
                    if ($value->children) {
                        foreach ($value->children as $chil) {
                            $children2[] = $chil->children;
                        }
                    }
                    $data[] = [
                        'id' => $value->id,
                        'title' => $value->title,
                        'link' => $value->link,
                        'order' => $value->order,
                        'description' => $value->description,
                        'children' => $value->children
                    ];
                }
            }

            return $data;
        } catch (Exception $e) {
            throw $e;
        }
    }



    public function getParent($menu_id)
    {
        try {
            $data = [];
            $menu = $this->_menuItem->select('id', 'parent_id', 'order', 'title', 'link', 'level')->where('parent_id', null)->where('menu_id', $menu_id)->orderBy('order', 'asc')->get();
            if ($menu) {
                foreach ($menu as $key => $value) {
                    $children2 = [];
                    if ($value->children) {
                        foreach ($value->children as $chil) {
                            $children2[] = $chil->children;
                        }
                    }
                    $data[] = [
                        'id' => $value->id,
                        'title' => $value->title,
                        'order' => $value->order,
                        'children' => $value->children
                    ];
                }
            }

            return $data;
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
            if ($this->level($data['parent_id']) == 4) {
                return 'Sub menu should not exceed 3 levels.';
            }
            $result = $this->_menuItem->create($data);
            $this->storage();
            return $result;
        } catch (Exception $e) {
            throw $e;
        }
    }


    /**
     * Update projects
     * @param string name
     * @param string description
     * @param date start_time
     * @param date end_time
     *
     * @author huynhtuvinh87@gmail.com
     */
    public function update($id, $request)
    {
        try {
            if ($this->level($request->parent_id) == 4) {
                return 'Sub menu should not exceed 3 levels.';
            }
            $result = $this->_menuItem->where('id', $id)->update([
                'parent_id' => $request->parent_id,
                'level' => $this->level($request->parent_id),
                'title' => $request->title,
                'link' => $request->link
            ]);
            $this->storage();
            return $this->_menuItem->where('id', $id)->first();
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
            $result = $this->_menuItem->where('id', $id)->delete();
            $this->storage();
            return $result;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Get view
     * @author huynhtuvinh87@gmail.com
     */
    public function level($id)
    {
        try {
            if (is_int($id)) {
                $query = $this->_menuItem->select('level')->where('id', $id)->first();
                return $query->level + 1;
            } else {
                return 1;
            }
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
            $query = $this->_menuItem->select('*')->where('id', $id)->first();
            return $query;
        } catch (Exception $e) {
            throw $e;
        }
    }
    public function updateOrder($request)
    {
        try {
            $result = $this->_menuItem->where('id', $request->id)->update([
                'order' => $request->order,
            ]);
            $this->storage();
            return $result;
        } catch (Exception $e) {
            throw $e;
        }
    }
    public function storage()
    {
        $menu = $this->_menu->select('id', 'name')->get();
        $data = [];
        foreach ($menu as $key => $value) {
            $data['menu'][$value->name] = $value->items->toArray();
        }
        Storage::disk('local')->put('public/menu.json', json_encode($data['menu']));
    }
}
