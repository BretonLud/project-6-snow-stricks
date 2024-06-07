<?php

namespace App\Service;

use App\Entity\Category;
use App\Repository\CategoryRepository;

readonly class CategoryService
{
    public function __construct(private CategoryRepository $groupRepository)
    {
    }
    
    /**
     * @return Category[]
     */
    public function getCategories(): array
    {
        return $this->groupRepository->findAll();
    }
    
    public function save(Category $category, true $true): void
    {
        $this->groupRepository->save($category, $true);
    }
    
    public function remove(Category $category, true $true): void
    {
        $this->groupRepository->remove($category, $true);
    }
}
