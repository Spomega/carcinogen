<?php

namespace App\Controller;

use App\Entity\MicroPost;
use App\Repository\MicroPostRepositoryInterface;
use App\UseCase\MicroPostUseCase;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MicroPostController extends AbstractController
{

    function __construct(private MicroPostUseCase $microPostUseCase) {}
    #[Route('/micro/post', name: 'app_micro_post',methods: ['GET'])]
    public function index(): Response
    {
        dd($this->microPostUseCase->findAllPost());
        return $this->render('micro_post/index.html.twig', [
            'controller_name' => 'MicroPostController',
        ]);
    }

    #[Route('micro/post', name: 'app_micro_post_create', methods: ['POST'])]
    public function create(): Response
    {
        $microPost = new MicroPost();
        $microPost->setText('Some random text' . rand(0, 100));
        $microPost->setTitle('Some random title' . rand(0, 100));
        $microPost->setCreated(new \DateTime());
        $this->microPostUseCase->savePost($microPost);
        return new Response('Saved new post with id ' . $microPost->getId());
    }
}
