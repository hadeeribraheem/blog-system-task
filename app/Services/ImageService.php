<?php

namespace App\Services;

use App\Actions\DeleteFileFromPublicAction;
use App\traits\upload_image;
use Illuminate\Support\Facades\DB;

class ImageService
{
    use Upload_image;

    protected string $defaultImage = 'default.png';
    // Delete the old image if it exists
    public function deleteOldImage($model): void
    {
        $imageName = $model->image->path;
        if ($imageName && $imageName !== $this->defaultImage) {
            DeleteFileFromPublicAction::delete($imageName);
        }

        $model->image?->delete();
    }
}
