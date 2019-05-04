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
     * @var OptionList
     */
    protected $optionList;

    /**
     * Значение выбранного элемента списка по умолчанию
     *
     * @var string
     */
    protected $selectedValue = '';

    /**
     * @var OptGroup[]
     */
    protected $optGroups = [];

    /**
     * SelectField constructor.
     *
     * @param array $settings
     *
     * @throws \Scaleplan\Form\Exceptions\FieldException
     */
    public function __construct(array $settings)
    {
        if (isset($settings['optgroups']) && \is_array($settings['optgroups'])) {
            foreach ($settings['optgroups'] as $optgroup) {
                $this->optGroups[] = new OptGroup($optgroup);
            }
        } else {
            $this->optionList = new OptionList($settings['options'] ?? []);
        }

        unset($settings['optgroups'], $settings['options']);

        parent::__construct($settings);
    }

    /**
     * @return OptionList
     */
    public function getOptionList() : OptionList
    {
        return $this->optionList;
    }

    /**
     * @return OptGroup[]
     */
    public function getOptGroups() : array
    {
        return $this->optGroups;
    }

    /**
     * Установить текст пустого элемента списка
     *
     * @param $emptyText - текст
     */
    public function setEmptyText($emptyText) : void
    {
        $this->emptyText = $emptyText;
    }

    /**
     * Установить значение элемента списка, выбираемого по умолчанию
     *
     * @param $selectedValue - значение
     */
    public function setSelectedValue($selectedValue) : void
    {
        $this->selectedValue = $selectedValue;
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

        if (!$this->optGroups
            && $this->emptyText !== null
            && !isset($this->attributes['multiple'])
            && $this->optionList->count()) {

            $this->optionList->unshiftOption(new Option(['text' => $this->emptyText]));
        }

        if ($this->optGroups) {
            foreach ($this->optGroups as $optGroup) {
                $optGroup->getOptionList()->setSelectedValue($this->selectedValue);
                $optGroup->render()->appendTo($field);
            }
        } elseif ($this->optionList) {
            $this->optionList->setSelectedValue($this->selectedValue);
            $this->optionList->addToElement($field);
        }

        return $this->renderEnding($field);
    }
}
