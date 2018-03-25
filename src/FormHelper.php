<?php

namespace avtomon;

use phpQuery;

class FormHelper
{
    /**
     * Добавить атрибуты к элементу
     *
     * @param \phpQueryObject|\QueryTemplatesParse|\QueryTemplatesSource|\QueryTemplatesSourceQuery $el - элемент
     * @param array $attrs - массив атрибутов вида <имя атрибута> => <значение атрибута>
     * @param array $stopAttrs - массив имен атрибутов, которые добавлять не надо
     *
     * @return \phpQueryObject|\QueryTemplatesParse|\QueryTemplatesSource|\QueryTemplatesSourceQuery|null
     */
    public static function renderAttributes(&$el, array $attrs, array $stopAttrs = [])
    {
        unset($attrs['html'], $attrs['text'], $attrs['value'], $attrs['hint']);
        foreach ($attrs as $attr => $value) {
            if (!is_string($attr) || in_array($attr, $stopAttrs)) {
                continue;
            }

            $el->attr($attr, $value);
        }

        return $el;
    }
}