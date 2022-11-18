<?php

namespace App\Domain\UseCase;

use App\Domain\Entity\Category as EntityCategory;
use App\Domain\Repository\CategoryInterface;



class Category
{   
    public function __construct(private CategoryInterface $categoryRepository)
    {
        //dd($categoryRepository);
    }

    public function read(int $id): EntityCategory
    {   
        $category = $this->categoryRepository->get($id);
        
        if ($category === null) {
            throw CategoryIsNotExistException::fromId($id);
        }

        return $category;
    }

    /**
     * @return EntityCategory[]
     */
    public function readAll(): array 
    {   
        $categories = $this->categoryRepository->getAll();
        
        return $categories;
    }
}