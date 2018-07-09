<?php

namespace avtomon;

use phpQuery;

/**
 * Класс ошибок
 *
 * Class VariantException
 * @package avtomon
 */
class VariantException extends CustomException
{
}

/**
 * Класс вариантов радио-кнопки
 *
 * Class Variant
 * @package avtomon
 */
class Variant extends AbstractFormComponent
{
    /**
     * Тип переключателя: checkbox или radio
     *
     * @var string
     */
    protected $type = '';

    /**
     * Текст варианта переключателя
     *
     * @var string
     */
    protected $labelText = '';

    /**
     * Имя переключателя
     *
     * @var string
     */
    protected $name = '';

    /**
     * Значение вариата переключателя
     *
     * @var string
     */
    protected $value = '';

    /**
     * Конструктор
     *
     * @param array $settings - настройки объекта
     *
     * @throws VariantException
     * @throws \ReflectionException
     */
    public function __construct(array $settings)
    {
        if (empty($settings['type'])) {
            throw new VariantException('Не задан тип переключателя');
        }

        if (empty($settings['name'])) {
            throw new VariantException('Не задано имя');
        }

        if (empty($settings['labelText'])) {
            throw new VariantException('Не задан текст метки');
        }

        parent::__construct($settings);
    }

    /**
     * Установить тип переключателя (checkbox или radio)
     *
     * @param string $type - тип переключателя
     *
     * @throws VariantException
     */
    public function setType(string $type): void
    {
        if (!\in_array($type, ['radio', 'checkbox'], true)) {
            throw new VariantException('Значением типа может только checkbox и radio');
        }

        $this->type = $type;
    }

    /**
     * Отрендерить вариант переключателя
     *
     * @return \phpQueryObject|\QueryTemplatesParse|\QueryTemplatesSource|\QueryTemplatesSourceQuery|null
     *
     * @throws \Exception
     */
    public function render()
    {
        $field = phpQuery::pq('<input>')->attr('type', $this->type)->attr('name', $this->name);
        $label = phpQuery::pq('<label>')->text($this->labelText);
        $field->after($label);
        FormHelper::renderAttributes($label, $this->attributes, ['type']);

        return $field;
    }

    /**
     * Вернуть значение переключателя
     *
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }
}