<?php

namespace App\Actions;

class DeleteFileFromPublicAction
{
    public static function delete($name)
    {
        // full path for the image
        $path = public_path("images/{$name}");

        //check if file exists in this path or not ,  if exist delete it
        if (file_exists($path)) {
            return unlink($path);
        }

        return false; //if file does not exist
    }
}
