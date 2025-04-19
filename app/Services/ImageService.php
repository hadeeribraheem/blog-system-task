<?php

namespace App\Services;

use App\Actions\DeleteFileFromPublicAction;
use App\traits\upload_image;
use Illuminate\Support\Facades\DB;

class ImageService
{
    use Upload_image;

    protected string $defaultImage = 'default.png';public function resolveImage($file = null, $model = null, string $folder = 'users'): string
    {
        return DB::transaction(function () use ($file, $model, $folder) {
            // No file provided
            if (!$file) {
                return $model && $model->image ? $model->image->name : $this->defaultImage;
            }

            // Delete old image if exists
            if ($model && $model->image) {
                $this->deleteOldImage($model, $folder);
            }

            // Upload new image
            return $this->upload($file, $folder);
        });
    }
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
