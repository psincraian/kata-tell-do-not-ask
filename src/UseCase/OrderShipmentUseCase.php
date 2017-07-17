<?php

namespace Archel\TellDontAsk\UseCase;

use Archel\TellDontAsk\Domain\OrderStatus;
use Archel\TellDontAsk\Repository\OrderRepository;
use Archel\TellDontAsk\Service\ShipmentService;

/**
 * Class OrderShipmentUseCase
 * @package Archel\TellDontAsk\UseCase
 */
class OrderShipmentUseCase
{
    /**
     * @var OrderRepository
     */
    private $orderRepository;

    /**
     * @var ShipmentService
     */
    private $shipmentService;

    public function __construct(OrderRepository $orderRepository, ShipmentService $shipmentService)
    {
        $this->orderRepository = $orderRepository;
        $this->shipmentService = $shipmentService;
    }

    /**
     * @param OrderShipmentRequest $request
     * @throws OrderCannotBeShippedException
     * @throws OrderCannotBeShippedTwiceException
     */
    public function run(OrderShipmentRequest $request) : void
    {
        $order = $this->orderRepository->getById($request->getOrderId());

        if (!$order->canBeShipped()) {
            throw new OrderCannotBeShippedException();
        }

        if ($order->shipped()) {
            throw new OrderCannotBeShippedTwiceException();
        }

        $this->shipmentService->ship($order);
        $order->ship();

        $this->orderRepository->save($order);
    }
}