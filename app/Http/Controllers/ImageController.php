<?php

namespace App\Http\Controllers;

use Image;

class ImageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }
    public function resize($path)
    {
        $arr = explode('/', $path);
        $name = $arr[count($arr) - 1];
        if (\Storage::disk('local')->get($path)) {
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
            return 'storage/images/' . $name;
        }

        $image->resize($thumb_w, $thumb_h)->save(storage_path('app/public/images/' . $name));
        return url('storage/images/' . $name);
    }
}
