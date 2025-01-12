<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\UserProfile;
use App\Repository\UserProfileRepository;
use App\UseCase\UserProfileUseCase;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HelloController extends AbstractController
{
    function __construct(private UserProfileUseCase $userProfileUseCase)
    {
    }
    private array $messages = [
        ['message' => 'Hello', 'created' => '2024/9/12'],
        ['message' => 'Hi', 'created' => '2024/10/12'],
        ['message' => 'New Beginning', 'created' => '2023/05/25'],
    ];

    #[Route('/', name: 'index')]
    public function index(): Response
    {

        $user =  new User();
        $user->setEmail('email1@email.com');
        $user->setPassword('password');

        $profile =  new UserProfile();
        $profile->setName('Sarah Connor');
        $profile->setUser($user);

        $this->userProfileUseCase->saveProfile($profile);

        return $this->render(
            'hello/index.html.twig',
            [
                'messages' => $this->messages,
                'limit' => 3
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
