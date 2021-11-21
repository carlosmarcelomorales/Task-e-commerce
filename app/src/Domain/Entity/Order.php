<?php

namespace App\Domain\Entity;

use App\Repository\OrderRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrderRepository::class)
 * @ORM\Table(name="`order`")
 */
class Order
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Cart::class, inversedBy="order")
     * @ORM\JoinColumn(nullable=false)
     */
    private $cart;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    public function __construct(int $price, Cart $cart)
    {
        $this->price = $price;
        $this->cart = $cart;
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getCart() : ?Cart
    {
        return $this->cart;
    }

    public function setCart($cart): void
    {
        $this->cart = $cart;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price): void
    {
        $this->price = $price;
    }
}
