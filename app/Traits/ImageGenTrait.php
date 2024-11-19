<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

trait ImageGenTrait
{

    /**
     * @param Request $request
     * @return $this|false|string
     */
    public function imageGenrator($image = null, $imgMain, $imageSizes = [], $path)
    {

       
        $code = hexdec(uniqid());

        $name_gen = $code . '.' . $image->getClientOriginalExtension();
        $width=($imgMain->width==0) ? null : $imgMain->width;
       
        $height = ($imgMain->height == 0) ? null : $imgMain->height;
        if($imgMain->height!=0 && $imgMain->height!=0)
        {
            Image::make($image)->resize($width, $height)->save($path . $name_gen);
        }else
        {
            Image::make($image)->save($path . $name_gen);
        }
        
        

       
        $save_url = $path . $name_gen;
        foreach ($imageSizes as $img) {
            $name_gen = $code . '_' . strtolower($img->name) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize($img->width, $img->height)->save($path . $name_gen);
        }
        return $save_url;
    }
    public function imageRemove($image = null, $imageSizes = [])
    {
        if(!empty($image))
        {
        if (file_exists($image)) {
            unlink($image);
        }
        foreach ($imageSizes as $img) {           
            
            $upload_img = explode('.', $image);
           
            $imgRemove = $upload_img[0] . "_" . strtolower($img->name) . "." . $upload_img[1];
            if (file_exists($imgRemove)) {
                unlink($imgRemove);
            }
        }
    }
    }
}
