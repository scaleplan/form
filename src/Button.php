<?php

namespace Scaleplan\Form;

use phpQuery;

/**
 * Класс кнопки
 *
 * Class Button
 *
 * @package Scaleplan\Form
 */
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
     */
    public function __construct(array $settings)
    {
        if (empty($settings['type'])) {
            $settings['type'] = 'button';
        }

        parent::__construct($settings);
    }

    /**
     * Установить текст
     *
     * @param $text - текст
     */
    public function setText($text) : void
    {
        $this->text = (string)$text;
    }

    /**
     * Отрендерить кнопку
     *
     * @return \phpQueryObject|null
     *
     * @throws \Exception
     */
    public function render() : ?\phpQueryObject
    {
        $button = phpQuery::pq('<button>');
        $button->text($this->text);
        FormHelper::renderAttributes($button, $this->attributes);

        return $button;
    }
}
