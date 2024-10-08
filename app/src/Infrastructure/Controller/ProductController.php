<?php

namespace App\Infrastructure\Controller;

use App\Application\Product\Add\Query;
use App\Application\Product\Add\QueryHandler;
use App\Application\Product\Delete\QueryHandler as DeleteQueryHandler;
use App\Application\Product\Delete\Query as DeleteQuery;
use App\Application\Product\ModifyAmount\QueryHandler as ModifyAmountQueryHandler;
use App\Application\Product\ModifyAmount\Query as ModifyAmountQuery;
use App\Domain\Shared\Exception\InvalidValueException;
use Doctrine\ORM\EntityNotFoundException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends AbstractController
{

    public function add(Request $request, QueryHandler $useCase): Response
    {
        $name = $request->get('name');
        $sellerId = $request->get('sellerId');
        $price = $request->get('price');
        $amount = $request->get('amount');

        try {
            $useCase(
                new Query(
                    (object)[
                        'name' => $name,
                        'sellerId' => (int)$sellerId,
                        'price' => $price,
                        'amount' => (int)$amount
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
            'message' => 'Product created successfully!',
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
            'message' => 'Product deleted successfully!',
            'status' => 200
        ]);
    }

    public function modifyAmount(Request $request, ModifyAmountQueryHandler $useCase) : Response
    {
        $productId = $request->get('productId');
        $increase = boolval($request->get('increase'));
        $units = $request->get('units');

        try {
            $useCaseResponse = $useCase(
                new ModifyAmountQuery(
                    (object)[
                        'productId' => (int)$productId,
                        'increase' => $increase,
                        'units' => (int)$units
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
            'message' => 'Now we have ' .$useCaseResponse->getAmount() . ' units',
            'status' => 200
        ]);

    }
}
