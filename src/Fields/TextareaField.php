<?php

namespace Scaleplan\Form\Fields;

use Scaleplan\Form\FormHelper;

/**
 * Class TextareaField
 *
 * @package Scaleplan\Form
 */
class TextareaField extends AbstractField
{
    /**
     * Отрендерить многострочное поле ввода
     *
     * @return null|\phpQueryObject
     *
     * @throws \Exception
     */
    public function render() : ?\phpQueryObject
    {
        $field = \phpQuery::pq('<textarea>');
        $field->val($this->value);
        $field->attr('name', $this->getName());
        FormHelper::renderAttributes($field, $this->attributes);

        return $this->renderEnding($field);
    }
}
