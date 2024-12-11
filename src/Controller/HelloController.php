<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HelloController
{
    private array $messages = ["Hello New Beginning","hi"];

    #[Route('/{limit<\d+>?3}', name: 'index')]
    public function index(int $limit): Response
    {
        return new Response(implode(",", array_splice($this->messages, 0, $limit)));
    }

    #[Route('/messages/{id<\d+>}', name: 'messages', methods: ['GET'])]
    public function showOne(int $id): Response
    {
        return new Response($this->messages[$id]);
    }
}
