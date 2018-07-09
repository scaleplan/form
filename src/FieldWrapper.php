<?php

namespace avtomon;

use phpQuery;

/**
 *
 *
 * Class FieldWrapperException
 * @package avtomon
 */
class FieldWrapperException extends CustomException
{
}

/**
 * Обертка полей формы
 *
 * Class FieldWrapper
 * @package avtomon
 */
class FieldWrapper extends AbstractFormComponent
{
    /**
     * Настройки объекта по умолчанию
     *
     * @var array
     */
    protected static $settings = [
        'tag' => 'div'
    ];

    /**
     * HTML-тег обертки
     *
     * @var string
     */
    protected $tag = '';

    /**
     * Отрендерить обертку поля
     *
     * @return null|\phpQueryObject|\QueryTemplatesParse|\QueryTemplatesPhpQuery|\QueryTemplatesSource|\QueryTemplatesSourceQuery|string
     *
     * @throws \Exception
     */
    public  function render()
    {
        $fieldWrapper = phpQuery::pq("<{$this->tag}>");
        FormHelper::renderAttributes($fieldWrapper, $this->attributes);

        return $fieldWrapper;
    }
}