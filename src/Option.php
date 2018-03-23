<?php

namespace avtomon;

class OptionException extends \Exception
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
     * Отрендерить элемент списка
     *
     * @return \phpQueryObject|\QueryTemplatesParse|\QueryTemplatesSource|\QueryTemplatesSourceQuery|null
     */
    public function render()
    {
        $option = phpQuery::pq('<option>')
            ->text($this->text)
            ->val($this->value);

        self::renderAttributes($option, $this->attributes);

        return $option;
    }
}