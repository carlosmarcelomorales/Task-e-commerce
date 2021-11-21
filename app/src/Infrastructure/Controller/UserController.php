<?php

namespace App\Infrastructure\Controller;

use App\Application\User\Add\Query;
use App\Application\User\Add\QueryHandler;
use App\Domain\Shared\Exception\InvalidValueException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends AbstractController
{

    public function add(Request $request, QueryHandler $useCase): Response
    {
        $name = $request->get('name');

        try {
            $useCase(
                new Query(
                    (object)[
                        'name' => $name,
                    ]
                )
            );
        } catch (InvalidValueException $e) {
            return $this->json([
                'message' => 'error',
                'status' =>  404
            ]);
        }

        return $this->json([
            'message' => 'User created successfully!',
            'status' => 200
        ]);
    }

}
