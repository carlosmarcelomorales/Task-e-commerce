<?php

namespace App\Tests;

use App\Application\Product\Add\Query;
use App\Application\Product\Add\QueryHandler;
use App\Domain\Entity\Seller;
use App\Domain\Repository\ProductRepositoryInterface;
use App\Domain\Repository\SellerRepositoryInterface;
use App\Domain\Shared\Exception\InvalidValueException;
use Faker\Factory;
use PHPUnit\Framework\TestCase;

class AddProductQueryHandlerTest extends TestCase
{
    /** @var \stdClass */
    protected $data;

    private $mocks;

    protected function setUp(): void
    {
        parent::setUp();

        $faker = Factory::create();
        $this->data = (object)[
            'name' => $faker->name,
            'sellerId' => 1,
            'price' => $faker->randomNumber(),
            'amount' => $faker->randomNumber()
        ];

    }

    public function testAddProduct()
    {
        $this->mocks[ProductRepositoryInterface::class] = $this->createMock(ProductRepositoryInterface::class);
        $this->mocks[SellerRepositoryInterface::class] = $this->createMock(SellerRepositoryInterface::class);
        $this->mocks[Seller::class] = $this->createMock(Seller::class);

        $this->mocks[SellerRepositoryInterface::class]->expects($this->once())
            ->method('findById')
            ->willReturn($this->mocks[Seller::class]);

        $this->mocks[ProductRepositoryInterface::class]->expects($this->once())
            ->method('add');


        $handler = new QueryHandler(
            $this->mocks[ProductRepositoryInterface::class],
            $this->mocks[SellerRepositoryInterface::class]
        );
        $query = new Query($this->data);

        $handler($query);

        $this->assertEquals($this->data->sellerId, $query->getSellerId());
    }

    public function testQueryWithIncorrectId()
    {
        $this->data->sellerId = 0;

        $this->expectException(InvalidValueException::class);
        $query = new Query($this->data);
    }

}
