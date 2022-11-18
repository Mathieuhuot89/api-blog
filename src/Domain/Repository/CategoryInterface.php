<?php

namespace App\Domain\Repository;

use App\Domain\Entity\Category;

interface CategoryInterface 
{
    public function get(int $id): ?Category;

    /**
     *
     * @return Category[]
     */
    public function getAll(): array;


}