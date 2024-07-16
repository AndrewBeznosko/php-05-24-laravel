<?php

namespace App\Repositories;

use App\Repositories\Contract\ImagesRepositoryContract;
use Exception;

class ImagesRepository implements ImagesRepositoryContract
{
    public function attach(\Illuminate\Database\Eloquent\Model $model, string $relation, array $images = [], ?string $directory = null): void
    {
        if (!method_exists($model, $relation)) {
            throw new Exception('Invalid relation');
        }

        if (!empty($images)) {
            foreach ($images as $image) {
                call_user_func([$model, $relation])->create([
                    'path' => compact('image', 'directory'),
                ]);
            }
        }
    }
}
