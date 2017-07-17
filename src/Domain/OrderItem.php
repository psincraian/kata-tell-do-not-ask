<?php

namespace Archel\TellDontAsk\Domain;

/**
 * Class OrderItem
 * @package Archel\TellDontAsk\Domain
 */
class OrderItem
{
    const ROUND_PRECISSION = 2;
    /**
     * @var Product
     */
    private $product;

    /**
     * @var int
     */
    private $quantity;

    /**
     * @var float
     */
    private $taxedAmount;

    /**
     * @var float
     */
    private $tax;

    /**
     * @return Product
     */
    public function getProduct() : Product
    {
        return $this->product;
    }

    /**
     * @param Product $product
     */
    public function setProduct(Product $product) : void
    {
        $this->product = $product;
    }

    /**
     * @return int
     */
    public function getQuantity() : int
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity(int $quantity) : void
    {
        $this->quantity = $quantity;
    }

    /**
     * @return float
     */
    public function getTaxedAmount() : float
    {
        return round($this->product->getUnitaryTaxAmount() * $this->getQuantity(), self::ROUND_PRECISSION);
    }

    /**
     * @param float $taxedAmount
     */
    public function setTaxedAmount(float $taxedAmount) : void
    {
        $this->taxedAmount = $taxedAmount;
    }

    /**
     * @return float
     */
    public function getTax() : float
    {
        return round($this->product->getUnitaryTax() * $this->getQuantity(), self::ROUND_PRECISSION);
    }

    /**
     * @param float $tax
     */
    public function setTax(float $tax) : void
    {
        $this->tax = $tax;
    }
}