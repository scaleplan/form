<?php

namespace Scaleplan\Form\Fields;

use PhpQuery\PhpQuery;
use PhpQuery\PhpQueryObject;
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
     * @return null|PhpQueryObject
     *
     * @throws \Exception
     */
    public function render() : ?PhpQueryObject
    {
        $field = PhpQuery::pq('<textarea>');
        $field->val($this->value);
        $field->attr('name', $this->getName());
        FormHelper::renderAttributes($field, $this->attributes);
        $this->getAttribute('required') && $field->parent()->attr('required', 'required');

        return $this->renderEnding($field);
    }
}
