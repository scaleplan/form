<?php

namespace avtomon;

class ButtonException extends \Exception
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
        if (empty($settings['text'])) {
            throw new ButtonException('Не задан текст кнопки');
        }

        parent::__construct($settings);
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