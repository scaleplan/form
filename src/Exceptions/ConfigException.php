<?php

namespace Scaleplan\Form\Exceptions;

/**
 * Class ConfigException
 *
 * @package Scaleplan\Form\Exceptions
 */
class ConfigException extends FormException
{
    public const MESSAGE = 'Ошибка конфигурации.';
    public const CODE = 406;
}
