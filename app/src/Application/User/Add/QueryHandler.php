<?php

namespace App\Application\User\Add;

use App\Domain\Entity\User;
use App\Domain\Repository\UserRepositoryInterface;
use App\Domain\Shared\Exception\InvalidValueException;

class QueryHandler
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepositoryInterface;

    public function __construct(UserRepositoryInterface $userRepositoryInterface)
    {
        $this->userRepositoryInterface = $userRepositoryInterface;
    }

    /**
     * @param Query $query
     * @throws InvalidValueException
     */
    public function __invoke(Query $query)
    {
        $this->validateLogic($query);

        $user = new User($query->getName());
        $this->userRepositoryInterface->add($user);
    }

    /**
     * @param Query $query
     * @throws InvalidValueException
     */
    public function validateLogic(Query $query)
    {
        if (empty($query->getName())) {
            throw new InvalidValueException('name', 'The name cant be empty!');
        }
    }
}
