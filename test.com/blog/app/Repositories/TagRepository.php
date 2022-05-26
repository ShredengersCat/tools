<?php
namespace App\Repositories;

use App\Interfaces\TagRepositoryInterface;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Collection;

class TagRepository implements TagRepositoryInterface
{
    public function getAllTag() : Collection
    {
        return Tag::all();
    }

    public function getTagById($tagId) : Tag
    {
        return Tag::whereId($tagId)->get()->first();
    }

    public function createTag(array $data) : Tag
    {
        return Tag::firstOrCreate($data);
    }

    public function updateTag(int $tagId, array $data)
    {
        Tag::whereId($tagId)->update($data);
    }

    public function deleteTag(int $tagId)
    {
        Tag::destroy($tagId);
    }
}
