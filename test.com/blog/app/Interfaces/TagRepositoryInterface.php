<?php
namespace App\Interfaces;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Collection;

interface TagRepositoryInterface
{
    public function getAllTag() : Collection;
    public function getTagById($tagId) : Tag;
    public function createTag(array $data) : Tag;
    public function updateTag(int $tagId, array $data);
    public function deleteTag(int $tagId);
}
