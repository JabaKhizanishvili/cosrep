<?php
namespace App\Services;

use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class FileUpload
{

    public static function image($file_path, $img, $resize, $object = null, $needs_thumb = null){

         //if object is set image, then it is image update action and needs to delete old image
            if($object){
                if ($object != 'noimage.jpg') {
                    if (File::exists(storage_path($file_path . $object))) {
                        File::delete(storage_path($file_path . $object));
                    }
                    //case for signature


                    if($needs_thumb){
                        if (File::exists(storage_path($file_path .'thumb/'. $object))) {
                            File::delete(storage_path($file_path .'thumb/'. $object));
                        }
                    }
                }
            }


            if(!is_dir(storage_path($file_path))) {
                File::makeDirectory(storage_path($file_path));
            }

            if($needs_thumb){
                if(!is_dir(storage_path($file_path . 'thumb/'))) {
                    File::makeDirectory(storage_path($file_path . 'thumb/'));
                }
            }

            $ext = $img->getClientOriginalExtension();
            //get image size
            $data = filesize($img->getRealPath());

            $name = date('Y-m-d_H-i-s');
            $fullName = $name . '.' . $ext;
            $kb =  (int) ($data / 1024);

            if($needs_thumb){
                $thumb = Image::make($img->getRealPath());
                    $thumb->resize($needs_thumb, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    $thumb->stream();
                $thumb->save(storage_path($file_path.'thumb/'.$fullName), config('meta.image_compress_value'));
            }

            $width = getimagesize($img)[0];

            if($width > $resize || $kb > 400){
                $image = Image::make($img->getRealPath());
                if ($width > $resize) {
                    $image->resize($resize, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    $image->stream();
                }
                $image->save(storage_path($file_path.$fullName), config('meta.image_compress_value'));
            }else{
                $path =  storage_path($file_path.$fullName);
                move_uploaded_file($img,$path);
            }

            //check if image is optimized itself and use php custom upload because intervention increases low image size
            // if($kb <= 500){
            //    $path =  storage_path($file_path.$fullName);
            //    move_uploaded_file($img,$path);

            // }else{

            //     $image = Image::make($img->getRealPath());
            //     if ($width > $resize) {
            //         $image->resize($resize, null, function ($constraint) {
            //             $constraint->aspectRatio();
            //         });
            //         $image->stream();
            //     }
            //     $image->save(storage_path($file_path.$fullName), config('meta.image_compress_value'));
            // }

            return $fullName;
    }


}
