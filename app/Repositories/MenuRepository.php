<?php

namespace App\Repositories;

use App\Models\Menu;
use App\Models\MenuItem;
use App\User;
use App\Contracts\MenuInterface;
use Exception;
use Illuminate\Support\Str;

class MenuRepository implements MenuInterface
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
    public function list()
    {
        try {
            $menu = $this->_menu->select('id', 'name')->get()->toArray();
            return $menu;
        } catch (Exception $e) {
            throw $e;
        }
    }


    /**
     * Create Employee
     *
     * @author huynhtuvinh87@gmail.com
     */
    public function create($name)
    {
        try {
            $result = $this->_menu->create(['data' => Str::slug($name, '')]);
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
            $result = $this->_menu->where('id', $id)->delete();
            $this->_menuItem->where('menu_id', $id)->delete();
            return $result;
        } catch (Exception $e) {
            throw $e;
        }
    }
}
