<?php
namespace App\Interfaces;

interface TagRepositoryInterface
{
    public function getAllTag();
    public function getTagById($tagId);
    public function createTag(array $tagDetails);
    public function updateTag($tagId, array $tagDetails);
    public function deleteTag($tagId);
}
