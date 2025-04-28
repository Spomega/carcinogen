<?php

namespace App\Controller;


use App\Entity\Comment;
use App\Entity\MicroPost;
use App\Entity\User;
use App\Entity\UserProfile;
use App\Repository\MicroPostRepositoryInterface;
use App\Repository\UserProfileRepository;
use App\UseCase\UserProfileUseCase;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Id;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HelloController extends AbstractController
{
    function __construct(private UserProfileUseCase $userProfileUseCase, private EntityManagerInterface $entityManager, private MicroPostRepositoryInterface $posts)
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

//        $user =  new User();
//        $user->setEmail('email1@email.com');
//        $user->setPassword('password');
//
//        $profile =  new UserProfile();
//        $profile->setName('Sarah Connor');
//        $profile->setUser($user);

//        $this->userProfileUseCase->saveProfile($profile);


        $post = new MicroPost();
        $post->setTitle('Hello');
        $post->setText('Hello');
        $post->setCreated(new \DateTime());

        $comment  = new Comment();
        $comment->setComment('This is a comment');

        $post->addComment($comment);
        $this->entityManager->persist($post);
        $this->entityManager->flush();



        // $post->setTitle('Hello');
        // $post->setText('Hello');
        // $post->setCreated(new DateTime());
         $poster = $this->posts->findPostById(11);
         $comments = $poster->getComments();
         //dd($post);
//         $comment = $post->getComments()[0];
//         $comment->setPost(null);
//         $comments->add($comment, true);

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
