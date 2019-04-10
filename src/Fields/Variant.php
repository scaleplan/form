<?php

namespace Scaleplan\Form\Fields;

use phpQuery;
use Scaleplan\Form\AbstractFormComponent;
use Scaleplan\Form\Exceptions\RadioVariantException;
use Scaleplan\Form\FormHelper;

/**
 * Класс вариантов радио-кнопки
 *
 * Class Variant
 *
 * @package Scaleplan\Form
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
     * @throws RadioVariantException
     */
    public function __construct(array $settings)
    {
        if (empty($settings['type'])) {
            throw new RadioVariantException('Не задан тип переключателя');
        }

        if (empty($settings['name'])) {
            throw new RadioVariantException('Не задано имя');
        }

        if (empty($settings['labelText'])) {
            throw new RadioVariantException('Не задан текст метки');
        }

        parent::__construct($settings);
    }

    /**
     * Установить тип переключателя (checkbox или radio)
     *
     * @param string $type - тип переключателя
     *
     * @throws RadioVariantException
     */
    public function setType(string $type) : void
    {
        if (!\in_array($type, ['radio', 'checkbox'], true)) {
            throw new RadioVariantException('Значением типа может только checkbox и radio');
        }

        $this->type = $type;
    }

    /**
     * Отрендерить вариант переключателя
     *
     * @return \phpQueryObject|null
     *
     * @throws \Exception
     */
    public function render() : ?\phpQueryObject
    {
        $field = phpQuery::pq('<input>');
        $field->attr('type', $this->type);
        $field->attr('name', $this->name);

        $label = phpQuery::pq('<label>');
        $label->text($this->labelText);

        $field->after($label);

        FormHelper::renderAttributes($label, $this->attributes, ['type']);

        return $field;
    }

    /**
     * Вернуть значение переключателя
     *
     * @return string
     */
    public function getValue() : string
    {
        return $this->value;
    }
}
