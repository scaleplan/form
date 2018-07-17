<small>avtomon</small>

Variant
=======

Класс вариантов радио-кнопки

Описание
-----------

Class Variant

Сигнатура
---------

- **class**.
- Является подклассом класса [`AbstractFormComponent`](../avtomon/AbstractFormComponent.md).

Свойства
----------

class устанавливает следующие свойства:

- [`$type`](#$type) &mdash; Тип переключателя: checkbox или radio
- [`$labelText`](#$labelText) &mdash; Текст варианта переключателя
- [`$name`](#$name) &mdash; Имя переключателя
- [`$value`](#$value) &mdash; Значение вариата переключателя

### `$type` <a name="type"></a>

Тип переключателя: checkbox или radio

#### Сигнатура

- **protected** property.
- Значение `string`.

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
- [`setType()`](#setType) &mdash; Установить тип переключателя (checkbox или radio)
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
    - [`avtomon\VariantException`](../avtomon/VariantException.md)
    - [`ReflectionException`](http://php.net/class.ReflectionException)

### `setType()` <a name="setType"></a>

Установить тип переключателя (checkbox или radio)

#### Сигнатура

- **public** method.
- Может принимать следующий параметр(ы):
    - `$type` (`string`) - тип переключателя
- Ничего не возвращает.
- Выбрасывает одно из следующих исключений:
    - [`avtomon\VariantException`](../avtomon/VariantException.md)

### `render()` <a name="render"></a>

Отрендерить вариант переключателя

#### Сигнатура

- **public** method.
- Возвращает `mixed` value.
- Выбрасывает одно из следующих исключений:
    - [`Exception`](http://php.net/class.Exception)

### `getValue()` <a name="getValue"></a>

Вернуть значение переключателя

#### Сигнатура

- **public** method.
- Возвращает `string` value.

