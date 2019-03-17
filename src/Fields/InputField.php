<?php

namespace Scaleplan\Form\Fields;

use Scaleplan\Form\FormHelper;

/**
 * Class InputField
 *
 * @package Scaleplan\Form
 */
class InputField extends AbstractField
{
    /**
     * Отрендерить однострочное поле ввода
     *
     * @return null|\phpQueryObject
     *
     * @throws \Exception
     */
    public function render() : ?\phpQueryObject
    {
        if (\in_array($this->getType(), ['radio', 'textarea', 'select', 'hidden'], true)) {
            return null;
        }

        $field = \phpQuery::pq('<input>')->attr('type', $this->getType());
        $field->val($this->value);
        $field->attr('name', $this->getName());

        FormHelper::renderAttributes($field, $this->attributes);

        return $this->renderEnding($field);
    }
}
