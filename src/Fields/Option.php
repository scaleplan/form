<?php

namespace Scaleplan\Form\Fields;

use phpQuery;
use Scaleplan\Form\AbstractFormComponent;
use Scaleplan\Form\FormHelper;

/**
 * Класс элементов выпадающих списков
 *
 * Class Option
 *
 * @package Scaleplan\Form
 */
class Option extends AbstractFormComponent
{
    /**
     * Текст элемента списка
     *
     * @var string
     */
    protected $text = '';

    /**
     * Значение элемента списка
     *
     * @var string
     */
    protected $value = '';

    /**
     * Вернуть текст элемента списка
     *
     * @return string
     */
    public function getText() : string
    {
        return $this->text;
    }

    /**
     * Вернуть значение элемента списка
     *
     * @return string
     */
    public function getValue() : string
    {
        return $this->value;
    }

    /**
     * Установить значение элемента списка
     *
     * @param $value - значение
     */
    public function setValue($value) : void
    {
        $this->value = (string)$value;
    }

    /**
     * Установить текст элемента списка
     *
     * @param $text - текст
     */
    public function setText($text) : void
    {
        $this->text = (string)$text;
    }

    /**
     * Отрендерить элемент списка
     *
     * @return \phpQueryObject|null
     *
     * @throws \Exception
     */
    public function render() : ?\phpQueryObject
    {
        $option = phpQuery::pq('<option>');
        $option->text($this->text ?: $this->value);
        $option->val($this->value ?: $this->text);

        FormHelper::renderAttributes($option, $this->attributes);

        return $option;
    }
}
