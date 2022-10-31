<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    #[Route('/articles', name: 'post_article', methods: ['POST'])]
    public function create(): JsonResponse
    {
        return $this->json(['title' => 'article créer']);
    }

    #[Route('/articles/{id}', name: 'read_article', methods: ['GET'])]
    public function read(int $id): JsonResponse
    {
        return $this->json(['id' => $id]);
    }

    #[Route('/articles', name: 'read_all_articles', methods: ['GET'])]
    public function readAll(): JsonResponse
    {
        return $this->json([
            ['title' => 'titre test'],
            ['title' => 'titre 2']

        ]);
    }

    #[Route('/articles/{id}', name: 'put_article', methods: ['PUT'])]
    public function update(int $id): JsonResponse
    {
        return $this->json(['id' => $id]);
    }

    #[Route('/articles/{id}', name: 'delete_article', methods: ['DELETE'])]
    public function delete(int $id): Response
    {
        return new Response(null, Response::HTTP_NO_CONTENT);
    }

}
