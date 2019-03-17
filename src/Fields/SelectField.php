<?php

namespace Scaleplan\Form\Fields;

use Scaleplan\Form\FormHelper;

/**
 * Class SelectField
 *
 * @package Scaleplan\Form
 */
class SelectField extends AbstractField
{
    /**
     * Текст пустого элемента списка
     *
     * @var string
     */
    protected $emptyText = '';

    /**
     * Элементы выпадающего списка
     *
     * @var array
     */
    protected $options = [];

    /**
     * Значение выбранного элемента списка по умолчанию
     *
     * @var string
     */
    protected $selectedValue = '';

    /**
     * SelectField constructor.
     *
     * @param array $settings
     *
     * @throws \Scaleplan\Form\Exceptions\FieldException
     */
    public function __construct(array $settings)
    {
        if (!empty($settings['options']) && \is_array($settings['options'])) {
            foreach ($settings['options'] as &$option) {
                $option = new Option($option);
            }

            unset($option);
        }

        parent::__construct($settings);
    }

    /**
     * Установить элементы выпадающего списка
     *
     * @param array $options - список объектов элементов
     */
    public function setOptions(array $options): void
    {
        foreach ($options as $option) {
            if (!($option instanceof Option)) {
                continue;
            }

            $this->options[] = $option;
        }
    }

    /**
     * Установить текст пустого элемента списка
     *
     * @param $emptyText - текст
     */
    public function setEmptyText($emptyText): void
    {
        $this->emptyText = $emptyText;
    }

    /**
     * Установить значение элемента списка, выбираемого по умолчанию
     *
     * @param $selectedValue - значение
     */
    public function setSelectedValue($selectedValue): void
    {
        $this->selectedValue = $selectedValue;
    }

    /**
     * Добавить элемент выпадающего списка
     *
     * @param Option $option - объект элемента списка
     */
    public function addOption(Option $option): void
    {
        $this->options[] = $option;
    }

    /**
     * Отрендерить поле выпадающего списка
     *
     * @return null|\phpQueryObject
     *
     * @throws \Exception
     */
    public function render() : ?\phpQueryObject
    {
        if ($this->getType() !== 'select') {
            return null;
        }

        $field = \phpQuery::pq('<select>');
        $field->val($this->value);
        $field->attr('name', $this->getName());
        FormHelper::renderAttributes($field, $this->attributes);

        if ($this->emptyText !== null) {
            array_unshift($this->options, new Option(['text' => $this->emptyText]));
        }

        foreach($this->options as $option) {
            if (
                $this->selectedValue !== null
                &&
                (
                    $this->selectedValue == $option->getValue()
                    ||
                    $this->selectedValue == $option->getText()
                )
            ) {
                $option->addAttribute('selected', 'selected');
            }

            $option->render()->appendTo($field);
        }

        return $this->renderEnding($field);
    }
}
