<?php

namespace Archel\TellDontAsk\Domain;

/**
 * Class Order
 * @package Archel\TellDontAsk\Domain
 */
class Order
{
    /**
     * @var float
     */
    private $total;

    /**
     * @var string
     */
    private $currency;

    /**
     * @var array
     */
    private $items = [];

    /**
     * @var float
     */
    private $tax;

    /**
     * @var OrderStatus
     */
    private $status;

    /**
     * @var int
     */
    private $id;

    public function __construct()
    {
    }

    /**
     * @return float
     */
    public function getTotal() : float
    {
        return $this->total;
    }

    /**
     * @param float $total
     */
    public function setTotal(float $total)
    {
        $this->total = $total;
    }

    /**
     * @return string
     */
    public function getCurrency() : string
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     */
    public function setCurrency(string $currency) : void
    {
        $this->currency = $currency;
    }

    /**
     * @return array
     */
    public function getItems() : array
    {
        return $this->items;
    }

    /**
     * @param OrderItem[] ...$items
     */
    public function setItems(OrderItem... $items) : void
    {
        $this->items = $items;
    }

    /**
     * @param OrderItem $item
     */
    public function addItem(OrderItem $item) : void
    {
        $this->items[] = $item;
    }

    public function addProductItem(Product $product, int $quantity)
    {
        // @todo instantiate OrderItem with required params
        $orderItem = new OrderItem();
        $orderItem->setProduct($product);
        $orderItem->setQuantity($quantity);
        $this->addItem($orderItem);

        $total = $this->getTotal() + $orderItem->getTaxedAmount();
        $this->setTotal($total);

        $tax = $this->getTax() + $orderItem->getTax();
        $this->setTax($tax);
    }

    /**
     * @return float
     */
    public function getTax() : float
    {
        return $this->tax;
    }

    /**
     * @param float $tax
     */
    public function setTax(float $tax) : void
    {
        $this->tax = $tax;
    }

    /**
     * @return OrderStatus
     */
    public function getStatus() : OrderStatus
    {
        return $this->status;
    }

    /**
     * @param OrderStatus $orderStatus
     */
    public function setStatus(OrderStatus $orderStatus) : void
    {
        $this->status = $orderStatus;
    }

    /**
     * @return int
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id) : void
    {
        $this->id = $id;
    }

    public function canBeShipped(): bool
    {
        return !($this->getStatus()->getType() === OrderStatus::CREATED
            ||$this->getStatus()->getType() === OrderStatus::REJECTED);
    }

    public function shipped(): bool
    {
        return $this->getStatus()->getType() === OrderStatus::SHIPPED;
    }

    public function ship(): void
    {
        $this->setStatus(OrderStatus::shipped());
    }

    public static function create(int $id, string $currency = 'EUR')
    {
        $order = new self();
        $order->setId($id);
        $order->setStatus(OrderStatus::created());
        $order->setCurrency($currency);
        $order->setTotal(0.0);
        $order->setTax(0.0);

        return $order;
    }
}