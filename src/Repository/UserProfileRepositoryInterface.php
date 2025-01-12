<?php

namespace App\Repository;

use App\Entity\UserProfile;

interface UserProfileRepositoryInterface
{

    public function saveProfile(UserProfile $userProfile): void;

}