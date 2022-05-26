<?php
namespace App\Service;

use App\Interfaces\TagRepositoryInterface;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Collection;


class TagService
{
    protected TagRepositoryInterface $tagRepository;

    public function __construct(TagRepositoryInterface $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    public function index() : Collection
    {
        return $this->tagRepository->getAllTag();
    }

    public function store(array $data) : Tag
    {
        return $this->tagRepository->createTag($data);
    }

    public function show(int $tagId) : Tag
    {
        return $this->tagRepository->getTagById($tagId);
    }

    public function update(int $tagId, array $data)
    {
        $this->tagRepository->updateTag($tagId, $data);
    }

    public function delete(int $tagId)
    {
        $this->tagRepository->deleteTag($tagId);
    }
}
