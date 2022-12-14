<?php

namespace App\Infrastructure\Controller;

use App\Domain\Entity\Category;
use App\Domain\UseCase\Category as UseCaseCategory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Throwable;

class CategoryController extends AbstractController
{
    public function __construct(private UseCaseCategory $categoryUseCase)
    {
    }

    #[Route('/categories', name: 'post_category', methods: ['POST'])]
    public function create(): JsonResponse
    {
        return $this->json(['title' => 'article créer']);
    }

    #[Route('/categories/{id}', name: 'read_category', methods: ['GET'])]
    public function read(int $id): JsonResponse
    {
        try {
            $categoryEntity = $this->categoryUseCase->read($id);
        } catch (Throwable $exception) {
            return $this->json(
                [
                    'error' => [
                        'code' => $exception->getCode(),
                        'message' => $exception->getMessage(),
                    ]
                ],
                Response::HTTP_NOT_FOUND
            );
        }

        return $this->json([
            'id' => $id,
            'name' => $categoryEntity->name,
        ]);
    }

    
    #[Route('/categories', name: 'read_all_categories', methods: ['GET'])]
    public function readAll(): JsonResponse
    {
        $categoriesEntity = $this->categoryUseCase->readAll();
        $categoriesForJson = array_map(
            static function (Category $categoryEntity): array {
                return [
                    'id' => $categoryEntity->id,
                    'name' => $categoryEntity->name,
                ];
            },
            $categoriesEntity
        );

        return $this->json($categoriesForJson);
    }
    

    #[Route('/categories/{id}', name: 'put_category', methods: ['PUT'])]
    public function update(int $id): JsonResponse
    {
        return $this->json(['id' => $id]);
    }

    #[Route('/categories/{id}', name: 'delete_category', methods: ['DELETE'])]
    public function delete(int $id): Response
    {
        return new Response(null, Response::HTTP_NO_CONTENT);
    }

}
