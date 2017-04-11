<?php

declare(strict_types=1);

namespace CharlieIndia\Pinbar\Output;

use CharlieIndia\Pinbar\Operation\Operation;

interface OutputManagerInterface
{
    /**
     * Prints output for $operation;
     *
     * @param Operation $operation
     */
    public function print(Operation $operation);
}
