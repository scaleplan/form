<?php

namespace Scaleplan\Form\Interfaces;

/**
 * Interface Render
 *
 * @package Scaleplan\Form\Interfaces
 */
interface RenderInterface
{
    /**
     * @return \phpQueryObject|null
     */
    public function render() : ?\phpQueryObject;
}
