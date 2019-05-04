<?php

namespace Scaleplan\Form\Fields;

/**
 * Class FieldFabric
 *
 * @package Scaleplan\Form
 */
class FieldFabric
{
    public const DEFAULT_TYPE = 'text';

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
            case 'select':
                return new SelectField($settings);

            case 'textarea':
                return new TextareaField($settings);

            case 'checkbox':
            case 'radio':
                return new SwitchField($settings);

            case 'hidden':
                return new HiddenField($settings);

            case 'template':
                return new TemplateField($settings);

            default:
                return new InputField($settings);
        }
    }
}
