<?php

namespace Scaleplan\Form\Exceptions;

/**
 * Class FieldException
 *
 * @package Scaleplan\Form\Exceptions
 */
class FieldException extends FormException
{
    public const MESSAGE = 'Ошибка создания поля формы.';
    public const CODE = 500;
}
