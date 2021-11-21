<?php

namespace App\Domain\Repository;

use App\Domain\Entity\User;

interface UserRepositoryInterface
{
    public function add(User $user) : void;

    public function findById(int $id) : User;
}
