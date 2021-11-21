<?php

namespace App\Infrastructure\Controller;

use App\Application\Cart\Add\Query;
use App\Application\Cart\Add\QueryHandler;
use App\Application\Cart\Delete\QueryHandler as DeleteQueryHandler;
use App\Application\Cart\Delete\Query as DeleteQuery;
use App\Domain\Shared\Exception\InvalidValueException;
use Doctrine\ORM\EntityNotFoundException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CartController extends AbstractController
{

    public function add(Request $request, QueryHandler $useCase): Response
    {
        $userId = $request->get('userId');
        $productId = $request->get('productId');

        try {
            $useCase(
                new Query(
                    (object)[
                        'userId' => (int)$userId,
                        'productId' => (int)$productId
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
            'message' => 'Product added successfully to the cart!',
            'status' => 200
        ]);
    }

    public function delete(Request $request, DeleteQueryHandler $useCase) : Response
    {
        $userId = $request->get('userId');
        $productId = $request->get('productId');

        try {
            $useCase(
                new DeleteQuery(
                    (object)[
                        'userId' => (int)$userId,
                        'productId' => (int)$productId
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
            'message' => 'Product deleted successfully from cart!',
            'status' => 200
        ]);
    }

}
