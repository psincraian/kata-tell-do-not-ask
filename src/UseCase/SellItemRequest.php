<?php

namespace Archel\TellDontAsk\UseCase;

/**
 * Class SellItemRequest
 * @package Archel\TellDontAsk\UseCase
 */
class SellItemRequest
{
    /**
     * @var int
     */
    private $quantity;

    /**
     * @var string
     */
    private $productName;

    public function __construct(string $productName, int $quantity)
    {
        $this->productName = $productName;
        $this->quantity = $quantity;
    }

    /**
     * @return int
     */
    public function getQuantity() : int
    {
        return $this->quantity;
    }

    /**
     * @return string
     */
    public function getProductName() : string
    {
        return $this->productName;
    }
}