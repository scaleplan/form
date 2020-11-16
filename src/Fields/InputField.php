<?php

namespace Scaleplan\Form\Fields;

use PhpQuery\PhpQuery;
use PhpQuery\PhpQueryObject;
use Scaleplan\Form\Exceptions\FieldException;
use Scaleplan\Form\FormHelper;
use function Scaleplan\Translator\translate;

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
     * @return null|PhpQueryObject
     *
     * @throws \Exception
     */
    public function render() : ?PhpQueryObject
    {
        $field = PhpQuery::pq('<input>')->attr('type', $this->getType());
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
     * @throws \ReflectionException
     * @throws \Scaleplan\DependencyInjection\Exceptions\ContainerTypeNotSupportingException
     * @throws \Scaleplan\DependencyInjection\Exceptions\DependencyInjectionException
     * @throws \Scaleplan\DependencyInjection\Exceptions\ParameterMustBeInterfaceNameOrClassNameException
     * @throws \Scaleplan\DependencyInjection\Exceptions\ReturnTypeMustImplementsInterfaceException
     */
    public function setType(string $type) : void
    {
        if (\in_array(
            $type,
            [self::TEXTAREA, self::SELECT, self::HIDDEN, self::TEMPLATE],
            true)
        ) {
            throw new FieldException(translate('form.input-not-supported-type', ['type' => $type,]));
        }

        $this->type = $type;
    }
}
