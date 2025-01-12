<?php

namespace App\UseCase;

use App\Entity\UserProfile;
use App\Repository\UserProfileRepositoryInterface;

class UserProfileUseCase
{
    function __construct(private UserProfileRepositoryInterface $userProfileRepository)
    {
    }


    public function saveProfile(UserProfile $userProfile): void
    {
        $this->userProfileRepository->saveProfile($userProfile);
    }
}
