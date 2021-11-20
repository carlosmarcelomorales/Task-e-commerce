<?php

namespace App\Infrastructure\Controller;

use App\Application\Seller\Add\Query;
use App\Application\Seller\Add\QueryHandler;
use App\Domain\Shared\Exception\InvalidValueException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SellerController extends AbstractController
{
    public function add(Request $request, QueryHandler $useCase): Response
    {

        $name = $request->get('name');

        try {
            $useCase(
                new Query(
                    (object)[
                        'name' => $name
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
            'message' => 'Seller created successfully!',
            'status' => 200
        ]);
    }

}
