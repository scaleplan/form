<?php

namespace avtomon;

use phpQuery;

class ButtonException extends CustomException
{
}

class Button extends AbstractFormComponent
{
    /**
     * Текст на кнопке
     *
     * @var string
     */
    protected $text = '';

    /**
     * Конструтктор
     *
     * @param array $settings - настройки объекта
     *
     * @throws ButtonException
     */
    public function __construct(array $settings)
    {
        parent::__construct($settings);
    }

    /**
     * Установить текст
     *
     * @param $text - текст
     */
    public function setText($text)
    {
        $this->text = (string) $text;
    }

    /**
     * Отрендерить объект
     *
     * @return false|null|\phpQueryObject|\QueryTemplatesParse|\QueryTemplatesPhpQuery|\QueryTemplatesSource|\QueryTemplatesSourceQuery|String
     */
    public function render()
    {
        $button = phpQuery::pq('<button>')->text($this->text);
        FormHelper::renderAttributes($button, $this->attributes);

        return $button;
    }
}