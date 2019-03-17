<?php

namespace Scaleplan\Form\Fields;

use Scaleplan\Form\FormHelper;

/**
 * Class HiddenField
 *
 * @package Scaleplan\Form
 */
class HiddenField extends AbstractField
{
    /**
     * Отрендерить скрытое поле ввода
     *
     * @return null|\phpQueryObject
     *
     * @throws \Exception
     */
    public function render() : ?\phpQueryObject
    {
        if ($this->getType() !== 'hidden') {
            return null;
        }

        $field = \phpQuery::pq('<input>')->attr('type', 'hidden');
        if (!\is_array($this->value)) {
            $this->value = [$this->value];
        }

        $field->attr('name', $this->getName());

        FormHelper::renderAttributes($field, $this->attributes);

        $field->val(array_shift($this->value));
        foreach ($this->value as $value) {
            $clone = $field->clone()->val($value);
            $field->after($field);
            $field = $clone;
        }

        return $this->renderEnding($field);
    }
}
