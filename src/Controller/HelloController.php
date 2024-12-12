<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HelloController extends AbstractController
{
    private array $messages = ["Hello New Beginning","hi"];

    #[Route('/{limit<\d+>?3}', name: 'index')]
    public function index(int $limit): Response
    {
        //return new Response(implode(",", array_splice($this->messages, 0, $limit)));

        return $this->render(
            'hello/index.html.twig',
            [
                'message' => implode(",", array_splice($this->messages, 0, $limit))
            ]
        );
    }

    #[Route('/messages/{id<\d+>}', name: 'messages', methods: ['GET'])]
    public function showOne(int $id): Response
    {
        $message = $id > count($this->messages) - 1 ? Sprintf("Message %d not found.", $id) : $this->messages[$id];
        return $this->render(
            'hello/show_one.html.twig',
            [
                'message' => $message,
            ]
        );
    }
}
