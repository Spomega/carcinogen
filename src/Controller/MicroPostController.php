<?php

namespace App\Controller;

use App\Entity\MicroPost;
use App\Form\MicroPostType;
use App\UseCase\MicroPostUseCase;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MicroPostController extends AbstractController
{
    function __construct(private MicroPostUseCase $microPostUseCase)
    {
    }
    #[Route('/micro-post', name: 'app_micro_post', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('micro_post/index.html.twig', [
            'posts' => $this->microPostUseCase->findAllPost(),
        ]);
    }

    #[Route('/micro-post', name: 'app_micro_post_create', methods: ['POST'])]
    public function create(): Response
    {
        $microPost = new MicroPost();
        $microPost->setText('Some random text' . rand(0, 100));
        $microPost->setTitle('Some random title' . rand(0, 100));
        $microPost->setCreated(new \DateTime());
        $this->microPostUseCase->savePost($microPost);
        return new Response('Saved new post with id ' . $microPost->getId());
    }

    #[Route('/micro-post/{post<\d+>}', name: 'app_micro_post_show', methods: ['GET'])]
    public function showOne(MicroPost $post): Response
    {
        return $this->render('micro_post/show.html.twig', [
            'post' => $post,
        ]);
    }

    #[Route('/micro-post/add', name: 'app_micro_post_add', methods: ['GET','POST'])]
    public function add(Request $request): Response
    {
        $form = $this->createForm(MicroPostType::class, new MicroPost());

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $post = $form->getData();
            $post->setCreated(new \DateTime());
            $this->microPostUseCase->savePost($post);

            // add a flash message
            $this->addFlash('success', 'Post Created!');

            return  $this->redirectToRoute('app_micro_post');
            // Redirect to the show page
        }

        return $this->render('micro_post/add.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/micro-post/{post}/edit', name: 'app_micro_post_edit', methods: ['GET','POST'])]
    public function edit(MicroPost $post, Request $request): Response
    {
        $form = $this->createForm(MicroPostType::class, $post);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $post = $form->getData();
            $this->microPostUseCase->savePost($post);

            // add a flash message
            $this->addFlash('success', 'Post Updatedd!');

            return  $this->redirectToRoute('app_micro_post');
            // Redirect to the show page
        }

        return $this->render('micro_post/add.html.twig', [
            'form' => $form,
        ]);
    }
}
