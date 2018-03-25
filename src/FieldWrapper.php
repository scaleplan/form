<?php

namespace avtomon;

use phpQuery;

class FieldWrapperException extends CustomException
{
}

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
     * @return false|null|\phpQueryObject|\QueryTemplatesParse|\QueryTemplatesPhpQuery|\QueryTemplatesSource|\QueryTemplatesSourceQuery|String
     */
    public  function render()
    {
        $fieldWrapper = phpQuery::pq("<{$this->tag}>");
        FormHelper::renderAttributes($fieldWrapper, $this->attributes);

        return $fieldWrapper;
    }
}