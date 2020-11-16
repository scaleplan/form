<?php

namespace Scaleplan\Form\Fields;

use PhpQuery\PhpQuery;
use PhpQuery\PhpQueryObject;
use Scaleplan\Form\AbstractFormComponent;
use Scaleplan\Form\FormHelper;

/**
 * Обертка полей формы
 *
 * Class FieldWrapper
 *
 * @package Scaleplan\Form
 */
class FieldWrapper extends AbstractFormComponent
{
    /**
     * Настройки объекта по умолчанию
     *
     * @var array
     */
    protected static $settings = [
        'tag' => 'div',
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
     * @return null|PhpQueryObject
     *
     * @throws \Exception
     */
    public function render() : ?PhpQueryObject
    {
        $fieldWrapper = PhpQuery::pq("<{$this->tag}>");
        FormHelper::renderAttributes($fieldWrapper, $this->attributes);

        return $fieldWrapper;
    }
}
