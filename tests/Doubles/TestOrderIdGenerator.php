<?php
/**
 * Created by PhpStorm.
 * User: petru
 * Date: 17/07/17
 * Time: 20:34
 */

namespace Archel\TellDontAskTest\Doubles;


use Archel\TellDontAsk\Service\OrderIdGenerator;

class TestOrderIdGenerator implements OrderIdGenerator
{

    public function nextId(): int
    {
        return 1;
    }
}