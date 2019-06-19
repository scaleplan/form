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
        foreach ($settings['optgroups'] ?? [] as $optgroup) {
            $this->optGroups[] = new OptGroup($optgroup);
        }

        $this->optionList = new OptionList($settings['options'] ?? []);

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
     * Отрендерить поле выпадающего списка
     *
     * @return null|\phpQueryObject
     *
     * @throws \Exception
     */
    public function render() : ?\phpQueryObject
    {
        $field = \phpQuery::pq('<select>');
        //$field->val($this->value);
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
                $optGroup->getOptionList()->setSelectedValue($this->value);
                $optGroup->render()->appendTo($field);
            }
        } elseif ($this->optionList) {
            $this->optionList->setSelectedValue($this->value);
            $this->optionList->addToElement($field);
        }

        return $this->renderEnding($field);
    }
}
