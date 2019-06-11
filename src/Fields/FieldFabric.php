<?php

namespace Scaleplan\Form\Fields;

/**
 * Class FieldFabric
 *
 * @package Scaleplan\Form
 */
class FieldFabric
{
    public const DEFAULT_TYPE = AbstractField::TEXT;

    /**
     * @param array $settings
     *
     * @return HiddenField|InputField|SelectField|SwitchField|TextareaField|TemplateField
     *
     * @throws \Scaleplan\Form\Exceptions\FieldException
     * @throws \Scaleplan\Form\Exceptions\RadioVariantException
     */
    public static function getField(array $settings)
    {
        $type = $settings['type'] ?: static::DEFAULT_TYPE;
        switch ($type) {
            case AbstractField::SELECT:
                return new SelectField($settings);

            case AbstractField::TEXTAREA:
                return new TextareaField($settings);

            case AbstractField::CHECKBOX:
            case AbstractField::RADIO:
                return new SwitchField($settings);

            case AbstractField::HIDDEN:
                return new HiddenField($settings);

            case AbstractField::TEMPLATE:
                return new TemplateField($settings);

            default:
                return new InputField($settings);
        }
    }
}
