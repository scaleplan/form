<?php

namespace Scaleplan\Form;

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
     * @param \phpQueryObject $el - элемент
     * @param array $attrs - массив атрибутов вида <имя атрибута> => <значение атрибута>
     * @param array $stopAttrs - массив имен атрибутов, которые добавлять не надо
     *
     * @return \phpQueryObject|null
     */
    public static function renderAttributes(\phpQueryObject $el, array $attrs, array $stopAttrs = self::STOP_ATTRS) : ?\phpQueryObject
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
