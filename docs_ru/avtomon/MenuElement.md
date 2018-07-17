<small>avtomon</small>

MenuElement
===========

Класс элементов меню

Описание
-----------

Class MenuElement

Сигнатура
---------

- **class**.
- Является подклассом класса [`AbstractFormComponent`](../avtomon/AbstractFormComponent.md).

Свойства
----------

class устанавливает следующие свойства:

- [`$settings`](#$settings) &mdash; Настройки объекта по умолчанию
- [`$text`](#$text) &mdash; Текст элемента меню
- [`$tag`](#$tag) &mdash; Тег элемента меню
- [`$hash`](#$hash) &mdash; Хэш ссылки, если элемента меню - ссылка

### `$settings` <a name="settings"></a>

Настройки объекта по умолчанию

#### Сигнатура

- **protected static** property.
- Значение `array`.

### `$text` <a name="text"></a>

Текст элемента меню

#### Сигнатура

- **protected** property.
- Значение `string`.

### `$tag` <a name="tag"></a>

Тег элемента меню

#### Сигнатура

- **protected** property.
- Значение `string`.

### `$hash` <a name="hash"></a>

Хэш ссылки, если элемента меню - ссылка

#### Сигнатура

- **protected** property.
- Значение `string`.

Методы
-------

Методы класса class:

- [`__construct()`](#__construct) &mdash; Конструктор
- [`setHash()`](#setHash) &mdash; Установить хэш элемента меню
- [`setText()`](#setText) &mdash; Установить текст элемента меню
- [`render()`](#render) &mdash; Отрендерить элемент меню

### `__construct()` <a name="__construct"></a>

Конструктор

#### Сигнатура

- **public** method.
- Может принимать следующий параметр(ы):
    - `$settings` (`array`) - настройки объекта
- Ничего не возвращает.
- Выбрасывает одно из следующих исключений:
    - [`avtomon\MenuElementException`](../avtomon/MenuElementException.md)
    - [`ReflectionException`](http://php.net/class.ReflectionException)

### `setHash()` <a name="setHash"></a>

Установить хэш элемента меню

#### Сигнатура

- **public** method.
- Может принимать следующий параметр(ы):
    - `$hash` (`string`) - хэш
- Ничего не возвращает.
- Выбрасывает одно из следующих исключений:
    - [`avtomon\MenuElementException`](../avtomon/MenuElementException.md)

### `setText()` <a name="setText"></a>

Установить текст элемента меню

#### Сигнатура

- **public** method.
- Может принимать следующий параметр(ы):
    - `$text` (`string`) - текст
- Ничего не возвращает.

### `render()` <a name="render"></a>

Отрендерить элемент меню

#### Сигнатура

- **public** method.
- Возвращает `mixed` value.
- Выбрасывает одно из следующих исключений:
    - [`Exception`](http://php.net/class.Exception)

