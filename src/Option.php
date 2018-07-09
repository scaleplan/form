<?php

namespace avtomon;

use phpQuery;

/**
 * Класс ошибки
 *
 * Class OptionException
 * @package avtomon
 */
class OptionException extends CustomException
{
}

/**
 * Класс элементов выпадающих списков
 *
 * Class Option
 * @package avtomon
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
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * Вернуть значение элемента списка
     *
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * Установить значение элемента списка
     *
     * @param $value - значение
     */
    public function setValue($value): void
    {
        $this->value = (string) $value;
    }

    /**
     * Установить текст элемента списка
     *
     * @param $text - текст
     */
    public function setText($text): void
    {
        $this->text = (string) $text;
    }

    /**
     * Отрендерить элемент списка
     *
     * @return \phpQueryObject|\QueryTemplatesParse|\QueryTemplatesSource|\QueryTemplatesSourceQuery|null
     *
     * @throws \Exception
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