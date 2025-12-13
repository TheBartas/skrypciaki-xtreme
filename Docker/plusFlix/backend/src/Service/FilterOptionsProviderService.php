<?php

namespace App\Service;

use App\Repository\CategoryRepository;
use App\Repository\TagRepository;
use App\Repository\ItemRepository;

class FilterOptionsProviderService
{
    public function __construct(
        private CategoryRepository $categoryRepository,
        private TagRepository $tagRepository,
        private ItemRepository $itemRepository
    ) {}

    public function getOptions(): array
    {
        return [
            'categories' => $this->categoryRepository->findAll(),
            'tags'       => $this->tagRepository->findAll(),
            'authors'    => $this->itemRepository->findAllDirectors(),
        ];
    }
}
