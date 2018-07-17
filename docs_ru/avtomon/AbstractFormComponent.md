<small>avtomon</small>

AbstractFormComponent
=====================

Базовый класс компанентов формы

Описание
-----------

Class AbstractFormComponent

Сигнатура
---------

- **abstract class**.

Свойства
----------

abstract class устанавливает следующие свойства:

- [`$attributes`](#$attributes) &mdash; Атрибуты элемента формы

### `$attributes` <a name="attributes"></a>

Атрибуты элемента формы

#### Сигнатура

- **protected** property.
- Значение `array`.

Методы
-------

Методы класса abstract class:

- [`__construct()`](#__construct) &mdash; Конструктор
- [`setAttributes()`](#setAttributes) &mdash; Установить значения атрибутов
- [`addAttribute()`](#addAttribute) &mdash; Добавить атрибут
- [`render()`](#render) &mdash; Превратить объект в HTML-разметку
- [`__toString()`](#__toString) &mdash; Вернуть объект как строку

### `__construct()` <a name="__construct"></a>

Конструктор

#### Сигнатура

- **public** method.
- Может принимать следующий параметр(ы):
    - `$settings` (`array`) - настройки объекта
- Ничего не возвращает.
- Выбрасывает одно из следующих исключений:
    - [`ReflectionException`](http://php.net/class.ReflectionException)

### `setAttributes()` <a name="setAttributes"></a>

Установить значения атрибутов

#### Сигнатура

- **public** method.
- Может принимать следующий параметр(ы):
    - `$attributes` (`array`) - массив атрибутов
- Ничего не возвращает.

### `addAttribute()` <a name="addAttribute"></a>

Добавить атрибут

#### Сигнатура

- **public** method.
- Может принимать следующий параметр(ы):
    - `$name` (`string`) - имя атрибута
    - `$value` (`string`) - значение атрибута
- Ничего не возвращает.

### `render()` <a name="render"></a>

Превратить объект в HTML-разметку

#### Сигнатура

- **public abstract** method.
- Возвращает `mixed` value.

### `__toString()` <a name="__toString"></a>

Вернуть объект как строку

#### Сигнатура

- **public** method.
- Возвращает `string` value.

