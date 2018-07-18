<small>avtomon</small>

RadioVariant
============

Сигнатура
---------

- **class**.
- Является подклассом класса [`AbstractFormComponent`](../avtomon/AbstractFormComponent.md).

Свойства
----------

class устанавливает следующие свойства:

- [`$labelText`](#$labelText) &mdash; Текст варианта переключателя
- [`$name`](#$name) &mdash; Имя переключателя
- [`$value`](#$value) &mdash; Значение вариата переключателя

### `$labelText` <a name="labelText"></a>

Текст варианта переключателя

#### Сигнатура

- **protected** property.
- Значение `string`.

### `$name` <a name="name"></a>

Имя переключателя

#### Сигнатура

- **protected** property.
- Значение `string`.

### `$value` <a name="value"></a>

Значение вариата переключателя

#### Сигнатура

- **protected** property.
- Значение `string`.

Методы
-------

Методы класса class:

- [`__construct()`](#__construct) &mdash; Конструктор
- [`render()`](#render) &mdash; Отрендерить вариант переключателя
- [`getValue()`](#getValue) &mdash; Вернуть значение переключателя

### `__construct()` <a name="__construct"></a>

Конструктор

#### Сигнатура

- **public** method.
- Может принимать следующий параметр(ы):
    - `$settings` (`array`) - настройки объекта
- Ничего не возвращает.
- Выбрасывает одно из следующих исключений:
    - [`avtomon\SectionException`](../avtomon/SectionException.md)
    - [`ReflectionException`](http://php.net/class.ReflectionException)

### `render()` <a name="render"></a>

Отрендерить вариант переключателя

#### Сигнатура

- **public** method.
- Возвращает `mixed` value.

### `getValue()` <a name="getValue"></a>

Вернуть значение переключателя

#### Сигнатура

- **public** method.
- Возвращает `string` value.

