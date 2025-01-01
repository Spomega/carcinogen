<?php

namespace App\Controller;

use App\Repository\MicroPostRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MicroPostController extends AbstractController
{

    function __construct(private MicroPostRepositoryInterface $microPostRepository) {}
    #[Route('/micro/post', name: 'app_micro_post')]
    public function index(): Response
    {
        dd($this->microPostRepository->findAllPost());
        return $this->render('micro_post/index.html.twig', [
            'controller_name' => 'MicroPostController',
        ]);
    }
}
