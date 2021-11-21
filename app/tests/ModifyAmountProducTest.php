<?php

namespace App\Tests;

use App\Application\Product\ModifyAmount\Query;
use App\Application\Product\ModifyAmount\QueryHandler;
use App\Application\Product\ModifyAmount\Response;
use App\Domain\Entity\Product;
use App\Domain\Repository\ProductRepositoryInterface;
use App\Domain\Shared\Exception\InvalidValueException;
use Faker\Factory;
use PHPUnit\Framework\TestCase;

class ModifyAmountProductTest extends TestCase
{
    /** @var \stdClass */
    protected $data;

    private $mocks;

    protected function setUp(): void
    {
        parent::setUp();

        $this->data = (object)[
            'productId' => 1,
            'increase' => true,
            'units' => 1
        ];
        $this->init();
    }

    public function testIncreaseAmountInOne(): void
    {
        $this->mocks[ProductRepositoryInterface::class]->expects($this->once())
            ->method('findById')
            ->willReturn($this->mocks[Product::class]);

        $this->mocks[Product::class]->expects($this->any())
            ->method('getAmount')
            ->willReturn(2);

        $handler = $this->initQueryHandler();

        $query = new Query($this->data);

        $response = $handler($query);
        $this->assertEquals(3, $response->getAmount());
        $this->assertInstanceOf(Response::class, $response);
    }

    public function testDecreaseAmountInOne(): void
    {

        $this->data->increase = false;

        $this->mocks[ProductRepositoryInterface::class]->expects($this->once())
            ->method('findById')
            ->willReturn($this->mocks[Product::class]);

        $this->mocks[Product::class]->expects($this->any())
            ->method('getAmount')
            ->willReturn(3);

        $handler = $this->initQueryHandler();

        $query = new Query($this->data);

        $response = $handler($query);
        $this->assertEquals(2, $response->getAmount());
        $this->assertInstanceOf(Response::class, $response);
    }

    public function testIncorrectNumberUnits()
    {
        $this->data->units = 0;

        $this->expectException(InvalidValueException::class);
        $query = new Query($this->data);
    }


    public function init()
    {
        $this->mocks[ProductRepositoryInterface::class] = $this->createMock(ProductRepositoryInterface::class);
        $this->mocks[Product::class] = $this->createMock(Product::class);
    }

    public function initQueryHandler()
    {
        return new QueryHandler($this->mocks[ProductRepositoryInterface::class]);
    }

}
