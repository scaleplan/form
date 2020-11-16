<?php

namespace Scaleplan\Form\Fields;

use PhpQuery\PhpQueryObject;

/**
 * Class OptionList
 *
 * @package Scaleplan\Form\Fields
 */
class OptionList
{
    /**
     * @var Option[]
     */
    protected $options = [];

    /**
     * OptionList constructor.
     *
     * @param array $options
     */
    public function __construct(array $options)
    {
        $this->setOptions($options);
    }

    /**
     * @param $option
     *
     * @return Option|array
     */
    protected function getOption($option) : Option
    {
        if (!$option instanceof Option) {
            return new Option($option);
        }

        return $option;
    }

    /**
     * Добавить элемент выпадающего списка
     *
     * @param Option|array $option - элемента списка
     */
    public function addOption($option) : void
    {
        $this->options[] = $this->getOption($option);
    }

    /**
     * Добавить элемент выпадающего списка
     *
     * @param Option|array $option - элемента списка
     */
    public function unshiftOption($option) : void
    {
        array_unshift($this->options, $this->getOption($option));
    }


    /**
     * Установить элементы выпадающего списка
     *
     * @param Option[]|array $options - список объектов элементов
     */
    public function setOptions(array $options) : void
    {
        foreach ($options as &$option) {
            $this->addOption($option);
        }

        unset($option);
    }

    /**
     * @param $selectedValue
     */
    protected function setSelectedIfEqual($selectedValue) : void
    {
        foreach ($this->options as $option) {
            if ($selectedValue !== null
                && ($selectedValue == $option->getValue() || $selectedValue == $option->getText())
            ) {
                $option->addAttribute('selected', 'selected');
            }
        }
    }

    /**
     * @param $selectedValue
     */
    public function setSelectedValue($selectedValue) : void
    {
        if (\is_array($selectedValue)) {
            foreach ($selectedValue as $value) {
                $this->setSelectedIfEqual($value);
            }
            return;
        }

        $this->setSelectedIfEqual($selectedValue);
    }

    /**
     * @return int
     */
    public function count() : int
    {
        return count($this->options);
    }

    /**
     * @param PhpQueryObject $element
     *
     * @return PhpQueryObject
     *
     * @throws \Exception
     */
    public function addToElement(PhpQueryObject $element) : PhpQueryObject
    {
        /** @var Option $option */
        foreach ($this->options as $option) {
            $option->render()->appendTo($element);
        }

        return $element;
    }
}
