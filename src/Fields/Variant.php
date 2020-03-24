<?php

namespace Scaleplan\Form\Fields;

use PhpQuery\PhpQuery;
use PhpQuery\PhpQueryObject;
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
    protected $text = '';

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
     * @var bool
     */
    protected $checked = false;

    /**
     * Конструктор
     *
     * @param array $settings - настройки объекта
     *
     * @throws RadioVariantException
     */
    public function __construct(array $settings)
    {
        if (empty($settings['text'])) {
            throw new RadioVariantException('Не задан текст метки');
        }

        parent::__construct($settings);
    }

    /**
     * @param string $name
     */
    public function setName(string $name) : void
    {
        $this->name = $name;
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
        if (!\in_array($type, [SwitchField::RADIO, SwitchField::CHECKBOX], true)) {
            throw new RadioVariantException('Значением типа может только checkbox и radio');
        }

        $this->type = $type;
    }

    /**
     * @param bool $checked
     */
    public function setChecked(bool $checked) : void
    {
        $this->checked = $checked;
    }

    /**
     * Отрендерить вариант переключателя
     *
     * @return PhpQueryObject|null
     *
     * @throws \Exception
     */
    public function render() : ?PhpQueryObject
    {
        $field = PhpQuery::pq('<input>');
        $field->attr('type', $this->type);
        $field->attr('name', $this->name);
        $this->checked && $field->attr('checked', $this->checked);
        $field->val($this->value);

        $span = PhpQuery::pq('<span>');
        $span->text($this->text);
        FormHelper::renderAttributes($field, $this->attributes);

        $label = PhpQuery::pq('<label>');
        $label->append($field);
        $label->append($span);

        return $label;
    }

    /**
     * Вернуть значение переключателя
     *
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }
}
