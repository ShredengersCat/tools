<?php
namespace App\Repositories;

use App\Interfaces\TagRepositoryInterface;
use App\Models\Tag;

class TagRepository implements TagRepositoryInterface
{
    public function getAllTag()
    {
        return Tag::all();
    }

    public function getTagById($tagId)
    {
        return Tag::findOrFail($tagId);
    }

    public function createTag(array $tagDetails)
    {
        return Tag::firstOrCreate($tagDetails);
    }

    public function updateTag($tagId, array $tagDetails)
    {
        return Tag::whereId($tagId)->update($tagDetails);
    }

    public function deleteTag($tagId)
    {
        Tag::destroy($tagId);
    }
}
