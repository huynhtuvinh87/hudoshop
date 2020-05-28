<?php

namespace App\Repositories;

use App\Models\Setting;
use App\Contracts\SettingInterface;
use Exception;

class SettingRepository implements SettingInterface
{

    protected $_setting;

    public function __construct()
    {
        $this->_setting = new Setting();
    }
    /**
     * Get list
     * @author huynhtuvinh87@gmail.com
     */
    public function list()
    {
        try {

            $query = $this->_setting->select('*')->get()->toArray();
            return $query;
        } catch (Exception $e) {
            throw $e;
        }
    }


    /**
     * Create
     *
     * @author huynhtuvinh87@gmail.com
     */
    public function update($request)
    {
        try {
            foreach ($this->list() as $col) {
                $this->_setting->where('option', $col['option'])->update([
                    'value' => $request->{$col['option']}
                ]);
            }
            $data = [];
            foreach ($this->list() as $value) {
                $data[$value['option']] = $value['value'];
            }
            \Storage::disk('local')->put('public/setting.json', json_encode($data));
            return TRUE;
        } catch (Exception $e) {
            throw $e;
        }
    }
}
