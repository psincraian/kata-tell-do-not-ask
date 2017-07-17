<?php

namespace Archel\TellDontAsk\Service;

interface OrderIdGenerator
{

    public function nextId(): int;
}
