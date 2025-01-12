<?php

namespace App\Repository;

use App\Entity\MicroPost;

interface MicroPostRepositoryInterface
{
    public function findAllPost(): array;
    public function findPostById(int $id): ?MicroPost;
    public function savePost(MicroPost $microPost): void;
}
