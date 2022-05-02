<?php
namespace App\Service;

use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Mockery\Exception;

class PostService
{
    public function store($data, $tagIds = null)
    {
        try {
            DB::beginTransaction();
            $data = $this->saveImage($data);
            $post = Post::firstOrCreate($data);
            if (count($tagIds) > 0) {
                $post->tags()->attach($tagIds);
            }
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            dd($exception);
            abort(code: 500);
        }
    }

    public function update($data, $tagIds, $post)
    {
        try {
            DB::beginTransaction();
            $data = $this->saveImage($data);
            $post->update($data);
            if (count($tagIds) > 0) {
                $post->tags()->sync($tagIds);
            }
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            abort(500);
        }
        return $post;
    }

    public function saveImage($data)
    {
        if (isset($data['preview_image'])) {
            $data['preview_image'] = Storage::put('/images', $data['preview_image']);
        }
        if (isset($data['main_image'])) {
            $data['main_image'] = Storage::put('/images', $data['main_image']);
        }
        return $data;
    }
}
