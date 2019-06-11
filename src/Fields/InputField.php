<?php

namespace Scaleplan\Form\Fields;

use Scaleplan\Form\Exceptions\FieldException;
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
        $field = \phpQuery::pq('<input>')->attr('type', $this->getType());
        $field->val($this->value);
        $field->attr('name', $this->getName());

        FormHelper::renderAttributes($field, $this->attributes);

        return $this->renderEnding($field);
    }

    /**
     * Установить тип поля
     *
     * @param string $type - тип
     *
     * @throws FieldException
     */
    public function setType(string $type) : void
    {
        if (\in_array(
            $type,
            [self::RADIO, self::CHECKBOX, self::TEXTAREA, self::SELECT, self::HIDDEN, self::TEMPLATE],
            true)
        ) {
            throw new FieldException("Тип $type не поддерживается для однострочных текстовых полей.");
        }

        $this->type = $type;
    }
}
