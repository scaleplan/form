<small>avtomon</small>

FormHelper
==========

Класс полезных методов формы

Описание
-----------

Class FormHelper

Сигнатура
---------

- **class**.

Методы
-------

Методы класса class:

- [`renderAttributes()`](#renderAttributes) &mdash; Добавить атрибуты к элементу

### `renderAttributes()` <a name="renderAttributes"></a>

Добавить атрибуты к элементу

#### Сигнатура

- **public static** method.
- Может принимать следующий параметр(ы):
    - `$el` (`phpQueryObject`|`QueryTemplatesParse`|`QueryTemplatesSource`|`QueryTemplatesSourceQuery`) &mdash; - элемент
    - `$attrs` (`array`) &mdash; - массив атрибутов вида &lt;имя атрибута&gt; =&gt; &lt;значение атрибута&gt;
    - `$stopAttrs` (`array`) &mdash; - массив имен атрибутов, которые добавлять не надо
- Может возвращать одно из следующих значений:
    - `phpQueryObject`
    - `QueryTemplatesParse`
    - `QueryTemplatesSource`
    - `QueryTemplatesSourceQuery`
    - `null`

