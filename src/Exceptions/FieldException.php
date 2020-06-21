<?php

namespace Scaleplan\Form\Exceptions;

/**
 * Class FieldException
 *
 * @package Scaleplan\Form\Exceptions
 */
class FieldException extends FormException
{
    public const MESSAGE = 'form.field-create-error';
    public const CODE    = 500;
}
