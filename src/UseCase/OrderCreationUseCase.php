<?php

namespace Archel\TellDontAsk\UseCase;

use Archel\TellDontAsk\Domain\Order;
use Archel\TellDontAsk\Domain\OrderItem;
use Archel\TellDontAsk\Domain\OrderStatus;
use Archel\TellDontAsk\Repository\OrderRepository;
use Archel\TellDontAsk\Repository\ProductCatalog;
use Archel\TellDontAsk\Service\OrderIdGenerator;

/**
 * Class OrderCreationUseCase
 * @author Daniel J. Perez <danieljordi@bab-soft.com>
 * @package Archel\TellDontAsk\UseCase
 */
class OrderCreationUseCase
{
    /**
     * @var OrderRepository
     */
    private $orderRepository;

    /**
     * @var ProductCatalog
     */
    private $productCatalog;

    /**
     * @var  OrderIdGenerator
     */
    private $orderIdGenerator;

    /**
     * OrderCreationUseCase constructor.
     * @param OrderRepository $orderRepository
     * @param ProductCatalog $productCatalog
     */
    public function __construct(OrderRepository $orderRepository, ProductCatalog $productCatalog, OrderIdGenerator $orderIdGenerator)
    {
        $this->orderRepository = $orderRepository;
        $this->productCatalog = $productCatalog;
        $this->orderIdGenerator = $orderIdGenerator;
    }

    public function run(SellItemsRequest $request): void
    {
        $id = $this->orderIdGenerator->nextId();
        $order = Order::create($id, "EUR");

        $itemsRequest = $request->getRequests();
        foreach ($itemsRequest as $itemRequest) {
            $product = $this->productCatalog->getByName($itemRequest->getProductName());

            if (empty($product)) {
                throw new UnknownProductException();
            }

            $order->addProductItem($product, $itemRequest->getQuantity());
        }

        $this->orderRepository->save($order);
    }
}
