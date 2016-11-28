<?php

declare(strict_types=1);

namespace CharlieIndia\Pinbar\Tests\Operation;

use CharlieIndia\Pinbar\Operation\Operation;
use PHPUnit\Framework\TestCase;

/**
 * @author Cristian Iturri <iturri.cf@gmail.com>
 */
class OperationTest extends TestCase
{
    private $op;

    protected function setUp()
    {
        $this->op = new Operation();
    }

    public function testSetType()
    {
        $this->op->setType(Operation::TYPE_SELL);

        $this->assertEquals(Operation::TYPE_SELL, $this->op->getType());

        $this->op->setType(Operation::TYPE_BUY);

        $this->assertEquals(Operation::TYPE_BUY, $this->op->getType());
    }

    /**
     * @expectedException \DomainException
     */
    public function testTypeException()
    {
        $this->op->setType(4);
    }

    public function testConstructor()
    {
        $op = new Operation();

        $this->assertEquals(Operation::TYPE_BUY, $op->getType());
    }

    /**
     * @expectedException \DomainException
     */
    public function testConstructorException()
    {
        $op = new Operation(7);
    }

    public function testSetQuantity()
    {
        $this->op->setQuantity(1);

        $this->assertEquals(1, $this->op->getQuantity());

        $this->op->setQuantity(10000);

        $this->assertEquals(10000, $this->op->getQuantity());
    }

    /**
     * @expectedException \DomainException
     */
    public function testQuantityException()
    {
        $this->op->setQuantity(0);
    }
}
