<?php

namespace Scaleplan\Form\Exceptions;

/**
 * Class FormException
 *
 * @package Scaleplan\Form\Exceptions
 */
class FormException extends \Exception
{
    public const MESSAGE = 'Ошибка конструктора формы.';
    public const CODE = 500;

    /**
     * FormException constructor.
     *
     * @param string $message
     * @param int $code
     * @param \Throwable|null $previous
     */
    public function __construct(string $message = '', int $code = 0, \Throwable $previous = null)
    {
        parent::__construct($message ?: static::MESSAGE, $code ?: static::CODE, $previous);
    }
}
