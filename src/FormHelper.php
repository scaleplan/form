<?php

namespace Scaleplan\Form;

use PhpQuery\PhpQueryObject;

/**
 * Класс полезных методов формы
 *
 * Class FormHelper
 *
 * @package Scaleplan\Form
 */
class FormHelper
{
    public const STOP_ATTRS = ['labelAfter'];

    /**
     * Добавить атрибуты к элементу
     *
     * @param PhpQueryObject $el - элемент
     * @param array $attrs - массив атрибутов вида <имя атрибута> => <значение атрибута>
     * @param array $stopAttrs - массив имен атрибутов, которые добавлять не надо
     *
     * @return PhpQueryObject|null
     */
    public static function renderAttributes(
        PhpQueryObject $el,
        array $attrs,
        array $stopAttrs = self::STOP_ATTRS
    ) : ?PhpQueryObject
    {
        unset($attrs['html'], $attrs['text'], $attrs['value'], $attrs['hint']);
        foreach ($attrs as $attr => $value) {
            if (\is_array($value)) {
                $value = implode(',', $value);
            }

            if (!\is_string($attr) || \in_array($attr, $stopAttrs, true)) {
                continue;
            }

            $el->attr($attr, $value);
        }

        return $el;
    }
}
