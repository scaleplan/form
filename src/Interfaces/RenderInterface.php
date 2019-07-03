<?php

namespace Scaleplan\Form\Interfaces;

use PhpQuery\PhpQueryObject;

/**
 * Interface Render
 *
 * @package Scaleplan\Form\Interfaces
 */
interface RenderInterface
{
    /**
     * @return PhpQueryObject|null
     */
    public function render() : ?PhpQueryObject;
}
