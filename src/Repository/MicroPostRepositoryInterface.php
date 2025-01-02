<?php

namespace App\Repository;

use App\Entity\MicroPost;

interface MicroPostRepositoryInterface
{
    public function findAllPost(): array;
    public function findPostById(MicroPost $microPost): ?array;
    public function savePost(MicroPost $microPost): void;
}