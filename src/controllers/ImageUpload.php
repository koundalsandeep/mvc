<?php

class ImageUpload extends Controller
{

    function uploadFile($file, $folder = 'uploads')
    {
        $fname = $file['name'];
        $path = BASE_PATH . '/images/' . $folder . '/';
        if (!is_dir($path)) {
            mkdir(BASE_PATH . '/images/' . $folder . '/', 0777, true);
        }
        $imageType = explode('/', $file['type']);
        if ($imageType[1] == 'jpg' || $imageType[1] == 'jpeg' || $imageType[1] == 'png') {
            if (file_exists($path . $fname)) {
                $name = explode('.', $fname);
                $rand = rand(1, 100);
                $fname = $name[0] . $rand . '.' . $name[1];
            }
            if (move_uploaded_file($file['tmp_name'], $path . $fname)) {
                return BASE_URL . 'images/' . $folder . '/' . $fname;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
