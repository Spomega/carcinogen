<?php

namespace App\UseCase;

use App\Entity\MicroPost;
use App\Repository\MicroPostRepositoryInterface;

class MicroPostUseCase
{

    function __construct(protected MicroPostRepositoryInterface $microPostRepository){}

    public function findAllPost(): array
    {
        return $this->microPostRepository->findAllPost();
    }

    public function findPostById(int $id): ?array
    {
        return $this->microPostRepository->findPostById($id);
    }

    public function savePost(MicroPost $microPost): void
    {
        $this->microPostRepository->savePost($microPost);
    }

}