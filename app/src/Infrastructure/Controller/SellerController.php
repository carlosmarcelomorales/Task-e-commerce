<?php

namespace App\Infrastructure\Controller;

use App\Application\Seller\Add\Query;
use App\Application\Seller\Add\QueryHandler;
use App\Application\Seller\Delete\Query as DeleteQuery;
use App\Application\Seller\Delete\QueryHandler as DeleteQueryHandler;
use App\Domain\Shared\Exception\InvalidValueException;
use Doctrine\ORM\EntityNotFoundException;
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

    public function delete(Request $request, DeleteQueryHandler $useCase) : Response
    {
        $id = $request->get('id');

        try {
            $useCase(
                new DeleteQuery(
                    (object)[
                        'id' => (int)$id
                    ]
                )
            );
        } catch (InvalidValueException|EntityNotFoundException $e) {
            return $this->json([
                'message' => 'error',
                'status' =>  404
            ]);
        }

        return $this->json([
            'message' => 'Seller deleted successfully!',
            'status' => 200
        ]);
    }

}
