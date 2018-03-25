<?php

namespace avtomon;

use phpQuery;

class OptionException extends CustomException
{
}

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
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * Вернуть значение элемента списка
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Установить значение элемента списка
     *
     * @param $value - значение
     */
    public function setValue($value)
    {
        $this->value = (string) $value;
    }

    /**
     * Установить текст элемента списка
     *
     * @param $text - текст
     */
    public function setText($text)
    {
        $this->text = (string) $text;
    }

    /**
     * Отрендерить элемент списка
     *
     * @return \phpQueryObject|\QueryTemplatesParse|\QueryTemplatesSource|\QueryTemplatesSourceQuery|null
     */
    public function render()
    {
        $option = phpQuery::pq('<option>')
            ->text($this->text ?: $this->value)
            ->val($this->value ?: $this->text);

        FormHelper::renderAttributes($option, $this->attributes);

        return $option;
    }
}