<small>avtomon</small>

Option
======

Класс элементов выпадающих списков

Описание
-----------

Class Option

Сигнатура
---------

- **class**.
- Является подклассом класса [`AbstractFormComponent`](../avtomon/AbstractFormComponent.md).

Свойства
----------

class устанавливает следующие свойства:

- [`$text`](#$text) &mdash; Текст элемента списка
- [`$value`](#$value) &mdash; Значение элемента списка

### `$text` <a name="text"></a>

Текст элемента списка

#### Сигнатура

- **protected** property.
- Значение `string`.

### `$value` <a name="value"></a>

Значение элемента списка

#### Сигнатура

- **protected** property.
- Значение `string`.

Методы
-------

Методы класса class:

- [`getText()`](#getText) &mdash; Вернуть текст элемента списка
- [`getValue()`](#getValue) &mdash; Вернуть значение элемента списка
- [`setValue()`](#setValue) &mdash; Установить значение элемента списка
- [`setText()`](#setText) &mdash; Установить текст элемента списка
- [`render()`](#render) &mdash; Отрендерить элемент списка

### `getText()` <a name="getText"></a>

Вернуть текст элемента списка

#### Сигнатура

- **public** method.
- Возвращает `string` value.

### `getValue()` <a name="getValue"></a>

Вернуть значение элемента списка

#### Сигнатура

- **public** method.
- Возвращает `string` value.

### `setValue()` <a name="setValue"></a>

Установить значение элемента списка

#### Сигнатура

- **public** method.
- Может принимать следующий параметр(ы):
    - `$value` &mdash; - значение
- Ничего не возвращает.

### `setText()` <a name="setText"></a>

Установить текст элемента списка

#### Сигнатура

- **public** method.
- Может принимать следующий параметр(ы):
    - `$text` &mdash; - текст
- Ничего не возвращает.

### `render()` <a name="render"></a>

Отрендерить элемент списка

#### Сигнатура

- **public** method.
- Возвращает `mixed` value.
- Выбрасывает одно из следующих исключений:
    - [`Exception`](http://php.net/class.Exception)

