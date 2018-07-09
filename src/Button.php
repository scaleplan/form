<?php

namespace avtomon;

use phpQuery;

/**
 * Класс ошибок
 *
 * Class ButtonException
 * @package avtomon
 */
class ButtonException extends CustomException
{
}

/**
 * Класс кнопки
 *
 * Class Button
 * @package avtomon
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
     *
     * @throws \ReflectionException
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
    public function setText($text): void
    {
        $this->text = (string) $text;
    }

    /**
     * Отрендерить кнопку
     *
     * @return null|\phpQueryObject|\QueryTemplatesParse|\QueryTemplatesPhpQuery|\QueryTemplatesSource|\QueryTemplatesSourceQuery|string
     *
     * @throws \Exception
     */
    public function render()
    {
        $button = phpQuery::pq('<button>')->text($this->text);
        FormHelper::renderAttributes($button, $this->attributes);

        return $button;
    }
}