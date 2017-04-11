<?php

declare(strict_types=1);

namespace CharlieIndia\Pinbar\Transformer;

/**
 * @author Cristian Iturri <iturri.cf@gmail.com>
 */
interface TransformerInterface
{
    /**
     * Transform an object into a plain representation.
     *
     * @param object $object
     *
     * @return array
     */
    public function transform($object);
}
