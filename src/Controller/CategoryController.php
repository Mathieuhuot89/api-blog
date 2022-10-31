<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    #[Route('/categories', name: 'post_category', methods: ['POST'])]
    public function create(): JsonResponse
    {
        return $this->json(['title' => 'article créer']);
    }

    #[Route('/categories/{id}', name: 'read_category', methods: ['GET'])]
    public function read(int $id): JsonResponse
    {
        return $this->json(['id' => $id]);
    }

    #[Route('/categories', name: 'read_all_categories', methods: ['GET'])]
    public function readAll(): JsonResponse
    {
        return $this->json([
            ['title' => 'titre test'],
            ['title' => 'titre 2']

        ]);
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
