<?php

namespace App\Tests;

use App\Application\Seller\Delete\Query;
use App\Application\Seller\Delete\QueryHandler;
use App\Domain\Entity\Seller;
use App\Domain\Repository\SellerRepositoryInterface;
use App\Domain\Shared\Exception\InvalidValueException;
use Faker\Factory;
use PHPUnit\Framework\TestCase;

class DeleteSellerTest extends TestCase
{
    /** @var \stdClass */
    protected $data;

    private $mocks;

    protected function setUp(): void
    {
        parent::setUp();

        $this->data = (object)[
            'id' => 1,
        ];

        $this->init();
    }

    public function testDeleteSeller(): void
    {
        $this->mocks[SellerRepositoryInterface::class]->expects($this->once())
            ->method('findById')
            ->willReturn($this->mocks[Seller::class]);

        $handler = $this->initQueryHandler();
        $query = new Query($this->data);

        $handler($query);

    }

    public function testInvalidSeller(): void
    {
        $this->data->id = 0;

        $this->expectException(InvalidValueException::class);
        $query = new Query($this->data);

    }

    public function init()
    {
        $this->mocks[SellerRepositoryInterface::class] = $this->createMock(SellerRepositoryInterface::class);
        $this->mocks[Seller::class] = $this->createMock(Seller::class);
    }

    public function initQueryHandler()
    {
        return new QueryHandler($this->mocks[SellerRepositoryInterface::class]);
    }
}
