<?php

require_once __DIR__.'/vendor/autoload.php';

use CharlieIndia\Pinbar\Calculator\Calculator;
use CharlieIndia\Pinbar\Operation\Operation;
use Commando\Command;

$console = new Command();
$console
    ->option()
    ->require()
    ->aka('amount')
    ->title('amount')
    ->description('El monto de dinero a operar.');

$console
    ->option()
    ->require()
    ->aka('price')
    ->title('price')
    ->description('El precio del papel a operar.');

$console
    ->option('q')
    ->require(false)
    ->aka('quantity')
    ->title('quantity')
    ->description('Calcula la operacion en base a cantidad de papeles en lugar de monto de dinero.')
    ->boolean();

$console
    ->option('s')
    ->require(false)
    ->aka('sell')
    ->title('sell')
    ->description('Simula una operacion de venta en lugar de compra.')
    ->boolean();

$calc = new Calculator();

$opType = $console['sell'] ? Operation::TYPE_SELL : Operation::TYPE_BUY;

$op = $calc->simulateAmount(floatval($console['amount']), floatval($console['price']), $opType);

echo $op;
