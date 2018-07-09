<small>avtomon</small>

Section
=======

Класс разделов формы

Описание
-----------

Class Section

Сигнатура
---------

- **class**.
- Является подклассом класса [`AbstractFormComponent`](../avtomon/AbstractFormComponent.md).

Свойства
----------

class устанавливает следующие свойства:

- [`$title`](#$title) &mdash; Заголовок раздела формы
- [`$fields`](#$fields) &mdash; Поля раздела
- [`$buttons`](#$buttons) &mdash; Кнопки раздела
- [`$id`](#$id) &mdash; Идентификатор раздела

### `$title` <a name="title"></a>

Заголовок раздела формы

#### Сигнатура

- **protected** property.
- Значение `string`.

### `$fields` <a name="fields"></a>

Поля раздела

#### Сигнатура

- **protected** property.
- Значение `array`.

### `$buttons` <a name="buttons"></a>

Кнопки раздела

#### Сигнатура

- **protected** property.
- Значение `array`.

### `$id` <a name="id"></a>

Идентификатор раздела

#### Сигнатура

- **protected** property.
- Значение `string`.

Методы
-------

Методы класса class:

- [`__construct()`](#__construct) &mdash; Конструктор
- [`setFields()`](#setFields) &mdash; Установить поля раздела
- [`addField()`](#addField) &mdash; Добавить поле к разделу
- [`appendField()`](#appendField) &mdash; Добавить поле в конец раздела
- [`prependField()`](#prependField) &mdash; Добавить поле в начало раздела
- [`deleteField()`](#deleteField) &mdash; Удалить поле раздела по имени
- [`setButtons()`](#setButtons) &mdash; Установить кнопки раздела
- [`addButton()`](#addButton) &mdash; Добавить кпопку к разделу
- [`setTitle()`](#setTitle) &mdash; Установить заголовок раздела
- [`render()`](#render) &mdash; Отрендерить раздел формы
- [`getFields()`](#getFields) &mdash; Вернуть поля раздела
- [`getTitle()`](#getTitle) &mdash; Вернуть заголовок раздела
- [`getId()`](#getId) &mdash; Вернуть идентификатор раздела

### `__construct()` <a name="__construct"></a>

Конструктор

#### Сигнатура

- **public** method.
- Может принимать следующий параметр(ы):
    - `$settings` (`array`) &mdash; - настройки объекта
- Ничего не возвращает.
- Выбрасывает одно из следующих исключений:
    - [`avtomon\FieldException`](../avtomon/FieldException.md)
    - [`avtomon\VariantException`](../avtomon/VariantException.md)
    - [`ReflectionException`](http://php.net/class.ReflectionException)

### `setFields()` <a name="setFields"></a>

Установить поля раздела

#### Сигнатура

- **public** method.
- Может принимать следующий параметр(ы):
    - `$fields` (`array`) &mdash; - список полей
- Ничего не возвращает.

### `addField()` <a name="addField"></a>

Добавить поле к разделу

#### Сигнатура

- **public** method.
- Может принимать следующий параметр(ы):
    - `$field` ([`Field`](../avtomon/Field.md)) &mdash; - объект поля
    - `$isAppend` (`bool`) &mdash; - добавлять поле в конец и в начала раздела
- Ничего не возвращает.

### `appendField()` <a name="appendField"></a>

Добавить поле в конец раздела

#### Сигнатура

- **public** method.
- Может принимать следующий параметр(ы):
    - `$field` ([`Field`](../avtomon/Field.md)) &mdash; - объект поля
- Ничего не возвращает.

### `prependField()` <a name="prependField"></a>

Добавить поле в начало раздела

#### Сигнатура

- **public** method.
- Может принимать следующий параметр(ы):
    - `$field` ([`Field`](../avtomon/Field.md)) &mdash; - объект поля
- Ничего не возвращает.

### `deleteField()` <a name="deleteField"></a>

Удалить поле раздела по имени

#### Сигнатура

- **public** method.
- Может принимать следующий параметр(ы):
    - `$field` ([`Field`](../avtomon/Field.md)) &mdash; - удаляемое поле
- Ничего не возвращает.

### `setButtons()` <a name="setButtons"></a>

Установить кнопки раздела

#### Сигнатура

- **public** method.
- Может принимать следующий параметр(ы):
    - `$buttons` (`array`) &mdash; - массив кнопок
- Ничего не возвращает.

### `addButton()` <a name="addButton"></a>

Добавить кпопку к разделу

#### Сигнатура

- **public** method.
- Может принимать следующий параметр(ы):
    - `$button` ([`Button`](../avtomon/Button.md)) &mdash; - объект кнопки
- Ничего не возвращает.

### `setTitle()` <a name="setTitle"></a>

Установить заголовок раздела

#### Сигнатура

- **public** method.
- Может принимать следующий параметр(ы):
    - `$title` (`string`) &mdash; - новый заголовок
- Ничего не возвращает.

### `render()` <a name="render"></a>

Отрендерить раздел формы

#### Сигнатура

- **public** method.
- Возвращает `mixed` value.
- Выбрасывает одно из следующих исключений:
    - [`Exception`](http://php.net/class.Exception)

### `getFields()` <a name="getFields"></a>

Вернуть поля раздела

#### Сигнатура

- **public** method.
- Возвращает `array` value.

### `getTitle()` <a name="getTitle"></a>

Вернуть заголовок раздела

#### Сигнатура

- **public** method.
- Возвращает `string` value.

### `getId()` <a name="getId"></a>

Вернуть идентификатор раздела

#### Сигнатура

- **public** method.
- Возвращает `string` value.

