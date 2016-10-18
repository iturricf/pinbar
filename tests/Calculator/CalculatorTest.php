<?php

declare(strict_types=1);

namespace CharlieIndia\Pinbar\Tests\Calculator;

use CharlieIndia\Pinbar\Calculator\Calculator;
use CharlieIndia\Pinbar\Operation\Operation;
use PHPUnit\Framework\TestCase;

/**
 * @author Cristian Iturri <iturri.cf@gmail.com>
 */
class CalculatorTest extends Testcase
{
    public function testSimulateAmount()
    {
        $calc = new Calculator();
        $op = $calc->simulateAmount(3000, 109.4);

        $this->assertEquals($op->getAmount(), 2953.80);
        $this->assertEquals($op->getTotal(), 3017.16);

        $op = $calc->simulateAmount(3100, 152);

        $this->assertEquals($op->getAmount(), 3040);
        $this->assertEquals($op->getTotal(), 3103.44);

        $op = $calc->simulateQuantity(10, 160);

        $this->assertEquals($op->getAmount(), 1600);
        $this->assertEquals($op->getTotal(), 1662.05);

        $op = $calc->simulateQuantity(27, 98, Operation::TYPE_SELL);

        $this->assertEquals($op->getAmount(), 2646);
        $this->assertEquals($op->getTotal(), 2582.94);

        $op = $calc->simulateQuantity(10, 178, Operation::TYPE_SELL);

        $this->assertEquals($op->getAmount(), 1780);
        $this->assertEquals($op->getTotal(), 1717.78);
    }
}
