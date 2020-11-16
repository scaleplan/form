<?php

namespace Scaleplan\Form\Fields;

use PhpQuery\PhpQuery;
use PhpQuery\PhpQueryObject;
use Scaleplan\Form\AbstractFormComponent;
use Scaleplan\Form\Exceptions\FieldException;
use Scaleplan\Form\FormHelper;
use function Scaleplan\Translator\translate;

/**
 * Class OptGroup
 *
 * @package Scaleplan\Form\Fields
 */
class OptGroup extends AbstractFormComponent
{
    /**
     * Элементы выпадающего списка
     *
     * @var OptionList
     */
    protected $optionList;

    /**
     * @var string
     */
    protected $label;

    /**
     * @var string
     */
    protected $class;

    /**
     * @return string
     */
    public function getClass() : string
    {
        return $this->class;
    }

    /**
     * @param string $class
     */
    public function setClass(string $class) : void
    {
        $this->class = $class;
    }

    /**
     * @return string
     */
    public function getLabel() : string
    {
        return $this->label;
    }

    /**
     * @param string $label
     */
    public function setLabel(string $label) : void
    {
        $this->label = $label;
    }

    /**
     * @return OptionList
     */
    public function getOptionList() : OptionList
    {
        return $this->optionList;
    }

    /**
     * @param OptionList $optionList
     */
    public function setOptionList(OptionList $optionList) : void
    {
        $this->optionList = $optionList;
    }

    /**
     * OptGroup constructor.
     *
     * @param array $settings
     *
     * @throws FieldException
     * @throws \ReflectionException
     * @throws \Scaleplan\DependencyInjection\Exceptions\ContainerTypeNotSupportingException
     * @throws \Scaleplan\DependencyInjection\Exceptions\DependencyInjectionException
     * @throws \Scaleplan\DependencyInjection\Exceptions\ParameterMustBeInterfaceNameOrClassNameException
     * @throws \Scaleplan\DependencyInjection\Exceptions\ReturnTypeMustImplementsInterfaceException
     */
    public function __construct(array $settings)
    {
        if (empty($settings['label'])) {
            throw new FieldException(translate('form.select-group-label-not-set'));
        }

        $this->setLabel($settings['label']);
        $this->setClass($settings['class'] ?? '');
        $this->setOptionList(new OptionList($settings['options'] ?? []));
        unset($settings['options'], $settings['label'], $settings['class']);

        parent::__construct($settings);
    }

    /**
     * @param string $class
     *
     * @return bool
     */
    public function hasClass(string $class) : bool
    {
        return strpos($this->getClass(), $class) !== false;
    }

    /**
     * @return PhpQueryObject
     *
     * @throws \Exception
     */
    public function render() : PhpQueryObject
    {
        $optGroup = PhpQuery::pq('<optgroup>');
        $optGroup->attr('label', $this->getLabel());
        $optGroup->attr('class', $this->getClass());
        FormHelper::renderAttributes($optGroup, $this->attributes);

        $this->optionList->addToElement($optGroup);

        return $optGroup;
    }
}
