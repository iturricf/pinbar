<?php

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

    public function __construct(int $type = self::TYPE_BUY)
    {
        $this->type = $type;
    }

    public function __toString()
    {
        $output = "Operacion compra de %d acciones por el monto de AR$ %.2f\n"
                . "Comision: AR$ %.2f\nIva Comisión: AR$ %.2f\n"
                . "Derecho de mercado: AR$ %.2f\nIva Derecho de mercado: AR$ %.2f\n"
                . "\nTotal operación: AR$ %.2f\n";

        return sprintf($output, $this->getQuantity(), $this->getAmount(), $this->getFee(), $this->getFeeTax(), $this->getMarketFee(), $this->getMarketFeeTax(), $this->getTotal());
    }

    public function getType(): int
    {
        return $this->type;
    }

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

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): Operation
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getFee(): float
    {
        return $this->fee;
    }

    public function setFee(float $fee): Operation
    {
        $this->fee = $fee;

        return $this;
    }

    public function getFeeTax(): float
    {
        return $this->feeTax;
    }

    public function setFeeTax(float $feeTax): Operation
    {
        $this->feeTax = $feeTax;

        return $this;
    }

    public function getMarketFee(): float
    {
        return $this->marketFee;
    }

    public function setMarketFee(float $marketFee): Operation
    {
        $this->marketFee = $marketFee;

        return $this;
    }

    public function getMarketFeeTax(): float
    {
        return $this->marketFeeTax;
    }

    public function setMarketFeeTax(float $marketFeeTax): Operation
    {
        $this->marketFeeTax = $marketFeeTax;

        return $this;
    }

    public function getAmount(): float
    {
        return round($this->getQuantity() * $this->getPrice(), 2);
    }

    public function getTotal(): float
    {
        $total = $this->getAmount() + ($this->type * ($this->getFee() + $this->getFeeTax() + $this->getMarketFee() + $this->getMarketFeeTax()));

        return round($total, 2);
    }
}
