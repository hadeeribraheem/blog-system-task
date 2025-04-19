<?php

namespace App\Actions;

class DeleteFileFromPublicAction
{
    public static function delete($name)
    {
        $path = public_path("images/{$name}");
        if (file_exists($path)) {
            return unlink($path);
        }

        return false;
    }
}
