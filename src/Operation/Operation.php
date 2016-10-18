<?php

declare(strict_types=1);

namespace CharlieIndia\Pinbar\Operation;

class Operation
{
    const TYPE_BUY = 1;
    const TYPE_SELL = -1;

    private $type;
    private $startedAt;
    private $finishedAt;
    private $stockName;
    private $price;
    private $quantity;
    private $fee;
    private $feeTax;
    private $marketFee;
    private $marketFeeTax;

    /**
     * Constructor
     *
     * @param int $type
     */
    public function __construct(int $type = self::TYPE_BUY)
    {
        $this->type = $type;
    }

    /**
     * Gets the type.
     *
     * @return int
     */
    public function getType(): int
    {
        return $this->type;
    }

    /**
     * Sets the type.
     *
     * @param int $type
     *
     * @return Operation
     */
    public function setType(int $type): Operation
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Gets the price.
     *
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * Sets the price.
     *
     * @param float $price
     *
     * @return Operation
     */
    public function setPrice(float $price): Operation
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Gets the stock quantity.
     *
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * Sets the stock quantity.
     *
     * @param int $quantity
     *
     * @return Operation
     */
    public function setQuantity(int $quantity): Operation
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Gets the fee.
     *
     * @return float
     */
    public function getFee(): float
    {
        return $this->fee;
    }

    /**
     * Sets the fee.
     *
     * @param float $fee
     *
     * @return Operation
     */
    public function setFee(float $fee): Operation
    {
        $this->fee = $fee;

        return $this;
    }

    /**
     * Gets the fee tax.
     *
     * @return float
     */
    public function getFeeTax(): float
    {
        return $this->feeTax;
    }

    /**
     * Sets the fee tax.
     *
     * @param float $feeTax
     *
     * @return Operation
     */
    public function setFeeTax(float $feeTax): Operation
    {
        $this->feeTax = $feeTax;

        return $this;
    }

    /**
     * Gets the market fee.
     *
     * @return float
     */
    public function getMarketFee(): float
    {
        return $this->marketFee;
    }

    /**
     * Sets the market fee.
     *
     * @param float $marketFee
     *
     * @return Operation
     */
    public function setMarketFee(float $marketFee): Operation
    {
        $this->marketFee = $marketFee;

        return $this;
    }

    /**
     * Gets the market fee tax.
     *
     * @return float
     */
    public function getMarketFeeTax(): float
    {
        return $this->marketFeeTax;
    }

    /**
     * Sets the market fee tax.
     *
     * @param float $marketFeeTax
     *
     * @return Operation
     */
    public function setMarketFeeTax(float $marketFeeTax): Operation
    {
        $this->marketFeeTax = $marketFeeTax;

        return $this;
    }

    /**
     * Gets the operation amount before taxes.
     *
     * @return float
     */
    public function getAmount(): float
    {
        return round($this->getQuantity() * $this->getPrice(), 2);
    }

    /**
     * Gets the operation amount after taxes.
     *
     * @return float
     */
    public function getTotal(): float
    {
        $total = $this->getAmount() + ($this->type * ($this->getFee() + $this->getFeeTax() + $this->getMarketFee() + $this->getMarketFeeTax()));

        return round($total, 2);
    }
}
