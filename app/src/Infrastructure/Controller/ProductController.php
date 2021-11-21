<?php

namespace App\Infrastructure\Controller;

use App\Application\Product\Add\Query;
use App\Application\Product\Add\QueryHandler;
use App\Domain\Shared\Exception\InvalidValueException;
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

        try {
            $useCase(
                new Query(
                    (object)[
                        'name' => $name,
                        'sellerId' => (int)$sellerId,
                        'price' => $price
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
            'message' => 'Product created successfully!',
            'status' => 200
        ]);

    }
}
