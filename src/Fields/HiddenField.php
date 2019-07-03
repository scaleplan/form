<?php

namespace Scaleplan\Form\Fields;

use PhpQuery\PhpQuery;
use PhpQuery\PhpQueryObject;
use Scaleplan\Form\FormHelper;

/**
 * Class HiddenField
 *
 * @package Scaleplan\Form
 */
class HiddenField extends AbstractField
{
    public const ALLOWED_TYPES = [self::HIDDEN,];

    /**
     * @return array|string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Отрендерить скрытое поле ввода
     *
     * @return null|PhpQueryObject
     *
     * @throws \Exception
     */
    public function render() : ?PhpQueryObject
    {
        $field = PhpQuery::pq('<input>')->attr('type', self::HIDDEN);
        if (!\is_array($this->value)) {
            $values = [$this->value];
        } else {
            $values = $this->value;
        }

        $field->attr('name', $this->getName());

        FormHelper::renderAttributes($field, $this->attributes);

        $field->val(array_shift($values));
        foreach ($values as $value) {
            $clone = $field->clone()->val($value);
            $field->after($field);
            $field = $clone;
        }

        return $this->renderEnding($field);
    }
}
