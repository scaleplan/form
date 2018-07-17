<small>avtomon</small>

Button
======

Класс кнопки

Описание
-----------

Class Button

Сигнатура
---------

- **class**.
- Является подклассом класса [`AbstractFormComponent`](../avtomon/AbstractFormComponent.md).

Свойства
----------

class устанавливает следующие свойства:

- [`$text`](#$text) &mdash; Текст на кнопке

### `$text` <a name="text"></a>

Текст на кнопке

#### Сигнатура

- **protected** property.
- Значение `string`.

Методы
-------

Методы класса class:

- [`__construct()`](#__construct) &mdash; Конструтктор
- [`setText()`](#setText) &mdash; Установить текст
- [`render()`](#render) &mdash; Отрендерить кнопку

### `__construct()` <a name="__construct"></a>

Конструтктор

#### Сигнатура

- **public** method.
- Может принимать следующий параметр(ы):
    - `$settings` (`array`) - настройки объекта
- Ничего не возвращает.
- Выбрасывает одно из следующих исключений:
    - [`ReflectionException`](http://php.net/class.ReflectionException)

### `setText()` <a name="setText"></a>

Установить текст

#### Сигнатура

- **public** method.
- Может принимать следующий параметр(ы):
    - `$text` - текст
- Ничего не возвращает.

### `render()` <a name="render"></a>

Отрендерить кнопку

#### Сигнатура

- **public** method.
- Возвращает `mixed` value.
- Выбрасывает одно из следующих исключений:
    - [`Exception`](http://php.net/class.Exception)

