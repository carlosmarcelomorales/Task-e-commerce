<?php

namespace App\Domain\Entity;

use App\Infrastructure\Repository\CartRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CartRepository::class)
 */
class Cart
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="carts", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\OneToMany (targetEntity=CartProduct::class, mappedBy="cart", cascade={"persist"})
     */
    private $cartProduct;

    /**
     * @ORM\Column(type="boolean")
     */
    private $payed;

    public function __construct(User $user)
    {
        $this->user = $user;
        $this->payed = 0;
        $this->cartProduct = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection|Product[]
     */
    public function getCartProduct(): Collection
    {
        return $this->cartProduct;
    }

    public function addProduct(Product $product)
    {
        $this->cartProduct->add(new CartProduct($product, $this));
    }

    public function removeProduct(Product $product): self
    {
        $this->cartProduct->removeElement($product);

        return $this;
    }

    public function getPayed(): ?bool
    {
        return $this->payed;
    }

    public function setPayed(bool $payed): self
    {
        $this->payed = $payed;

        return $this;
    }
}
