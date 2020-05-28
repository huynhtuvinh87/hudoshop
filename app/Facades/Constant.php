<?php

namespace App\Facades;

use Storage;
use Image;

class Constant
{
    public function getFileImage($link)
    {
        $name = str_replace('/thumbs', '', $link);
        $name = str_replace('http://', '', $name);
        $name = str_replace('https://', '', $name);
        $name = str_replace(request()->getHttpHost() . '/', '', $name);
        return $name;
    }
    public function getFileImageThumnail($link)
    {
        $name = str_replace('http://', '', $link);
        $name = str_replace('https://', '', $name);
        $name = str_replace(request()->getHttpHost() . '/', '', $name);
        return $name;
    }
    public function maker()
    {
        return json_decode(Storage::disk('local')->get('public/maker.json'));
    }
    public function category()
    {
        return json_decode(Storage::disk('local')->get('public/category.json'));
    }

    public function setting()
    {
        return json_decode(Storage::disk('local')->get('public/setting.json'));
    }

    public function menu()
    {
        return json_decode(Storage::disk('local')->get('public/menu.json'));
    }

    public function widget()
    {
        return json_decode(Storage::disk('local')->get('public/widget.json'));
    }

    public function price($price)
    {
        return number_format($price, 0, '', ',');
    }
    public function status()
    {
        return [
            1 => 'Hoạt động',
            2 => 'Không hoạt động'
        ];
    }

    public function resize($path)
    {
        $path_new = public_path($this->getFileImageThumnail($path));
        $link = $this->getFileImageThumnail($path);
        $path = $this->getFileImage($path);

        $image = Image::make(public_path($path));
        $width = $image->width();
        $height = $image->height();
        $new_width = $new_height = 200;
        if ($width > $height) {
            $thumb_w    =   $new_width;
            $thumb_h    =   $height * ($new_height / $width);
        }

        if ($width < $height) {
            $thumb_w    =   $width * ($new_width / $height);
            $thumb_h    =   $new_height;
        }

        if ($width == $height) {
            $thumb_w    =   $new_width;
            $thumb_h    =   $new_height;
        }
        $image->resize($thumb_w, $thumb_h)->save($path_new);
        return url($link);
    }
}
