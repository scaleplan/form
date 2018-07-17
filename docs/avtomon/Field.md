<small>avtomon</small>

Field
=====

Класс полей формы

Описание
-----------

Class Field

Сигнатура
---------

- **class**.
- Является подклассом класса [`AbstractFormComponent`](../avtomon/AbstractFormComponent.md).

Константы
---------

class устанавливает следующие константы:

- [`ALLOWED_TYPES`](#ALLOWED_TYPES) &mdash; Доступные виды полей ввода
- [`TEMPLATE_EXTENSION`](#TEMPLATE_EXTENSION) &mdash; Расширение файлов шаблонов полей

Свойства
----------

class устанавливает следующие свойства:

- [`$settings`](#$settings) &mdash; Настройки объекта по умолчанию
- [`$type`](#$type) &mdash; Тип поля
- [`$name`](#$name) &mdash; Имя поля
- [`$labelText`](#$labelText) &mdash; Текст метки поля
- [`$value`](#$value) &mdash; Значение поля
- [`$emptyText`](#$emptyText) &mdash; Текст пустого элемента списка
- [`$options`](#$options) &mdash; Элементы выпадающего списка
- [`$templatePath`](#$templatePath) &mdash; Путь к директории с шаблонами полей
- [`$template`](#$template) &mdash; Имя файла шаблона поля
- [`$hint`](#$hint) &mdash; Текст подсказки поля
- [`$hintHTML`](#$hintHTML) &mdash; HTML-разметка элемента подсказки
- [`$hintSelector`](#$hintSelector) &mdash; Селектор, по которому можно будет найти элемент подсказки в шаблоне
- [`$hintAttribute`](#$hintAttribute) &mdash; В какой атрибудт вставлять текст подсказки
- [`$variants`](#$variants) &mdash; Варианты радио-баттона
- [`$fieldWrapper`](#$fieldWrapper) &mdash; Объект обертки поля ввода
- [`$selectedValue`](#$selectedValue) &mdash; Значение выбранного элемента списка по умолчанию
- [`$renderedTemplate`](#$renderedTemplate) &mdash; phpQuery-объект шаблона поля

### `$settings` <a name="settings"></a>

Настройки объекта по умолчанию

#### Сигнатура

- **protected static** property.
- Значение `array`.

### `$type` <a name="type"></a>

Тип поля

#### Сигнатура

- **protected** property.
- Значение `string`.

### `$name` <a name="name"></a>

Имя поля

#### Сигнатура

- **protected** property.
- Значение `string`.

### `$labelText` <a name="labelText"></a>

Текст метки поля

#### Сигнатура

- **protected** property.
- Значение `string`.

### `$value` <a name="value"></a>

Значение поля

#### Сигнатура

- **protected** property.
- Значение `string`.

### `$emptyText` <a name="emptyText"></a>

Текст пустого элемента списка

#### Сигнатура

- **protected** property.
- Значение `string`.

### `$options` <a name="options"></a>

Элементы выпадающего списка

#### Сигнатура

- **protected** property.
- Значение `array`.

### `$templatePath` <a name="templatePath"></a>

Путь к директории с шаблонами полей

#### Сигнатура

- **protected** property.
- Значение `string`.

### `$template` <a name="template"></a>

Имя файла шаблона поля

#### Сигнатура

- **protected** property.
- Значение `string`.

### `$hint` <a name="hint"></a>

Текст подсказки поля

#### Сигнатура

- **protected** property.
- Значение `string`.

### `$hintHTML` <a name="hintHTML"></a>

HTML-разметка элемента подсказки

#### Сигнатура

- **protected** property.
- Значение `string`.

### `$hintSelector` <a name="hintSelector"></a>

Селектор, по которому можно будет найти элемент подсказки в шаблоне

#### Сигнатура

- **protected** property.
- Значение `string`.

### `$hintAttribute` <a name="hintAttribute"></a>

В какой атрибудт вставлять текст подсказки

#### Сигнатура

- **protected** property.
- Значение `string`.

### `$variants` <a name="variants"></a>

Варианты радио-баттона

#### Сигнатура

- **protected** property.
- Значение `array`.

### `$fieldWrapper` <a name="fieldWrapper"></a>

Объект обертки поля ввода

#### Сигнатура

- **protected** property.
- Может быть одного из следующих типов:
    - `null`
    - [`FieldWrapper`](../avtomon/FieldWrapper.md)

### `$selectedValue` <a name="selectedValue"></a>

Значение выбранного элемента списка по умолчанию

#### Сигнатура

- **protected** property.
- Значение `string`.

### `$renderedTemplate` <a name="renderedTemplate"></a>

phpQuery-объект шаблона поля

#### Сигнатура

- **protected** property.
- Может быть одного из следующих типов:
    - `null`
    - `phpQueryObject`
    - `QueryTemplatesParse`
    - `QueryTemplatesPhpQuery`
    - `QueryTemplatesSource`
    - `QueryTemplatesSourceQuery`

Методы
-------

Методы класса class:

- [`__construct()`](#__construct) &mdash; Конструктор
- [`setFieldWrapper()`](#setFieldWrapper) &mdash; Установить обертку поля
- [`setTemplate()`](#setTemplate) &mdash; Установить шаблон поля
- [`setType()`](#setType) &mdash; Установить тип поля
- [`setOptions()`](#setOptions) &mdash; Установить элементы выпадающего списка
- [`setVariants()`](#setVariants) &mdash; Установить варианты выбора переключателя
- [`addVariant()`](#addVariant) &mdash; Добавить вариант выбора переключателя
- [`setValue()`](#setValue) &mdash; Установить значение поля
- [`setText()`](#setText) &mdash; Установить имя поля
- [`setLabelText()`](#setLabelText) &mdash; Установить текст метки поля
- [`setEmptyText()`](#setEmptyText) &mdash; Установить текст пустого элемента списка
- [`setTemplatePath()`](#setTemplatePath) &mdash; Установить путь до директории с шаблонами полей
- [`setSelectedValue()`](#setSelectedValue) &mdash; Установить значение элемента списка, выбираемого по умолчанию
- [`addOption()`](#addOption) &mdash; Добавить элемент выпадающего списка
- [`getName()`](#getName) &mdash; Вернуть имя поля
- [`getType()`](#getType) &mdash; Вренуть тип поля
- [`getAttribute()`](#getAttribute) &mdash; Вернуть значение атрибута, если такой есть
- [`renderSelect()`](#renderSelect) &mdash; Отрендерить поле выпадающего списка
- [`renderFieldHint()`](#renderFieldHint) &mdash; Отрендерить подсказку поля
- [`renderLabel()`](#renderLabel) &mdash; Рендеринг метки поля
- [`getRenderedTemplate()`](#getRenderedTemplate) &mdash; Отрендерить поле представленное шаблоном
- [`renderInput()`](#renderInput) &mdash; Отрендерить однострочное поле ввода
- [`renderHidden()`](#renderHidden) &mdash; Отрендерить скрытое поле ввода
- [`renderSwitch()`](#renderSwitch) &mdash; Отрендерить переключатель
- [`renderTextarea()`](#renderTextarea) &mdash; Отрендерить многострочное поле ввода
- [`render()`](#render) &mdash; Отрендерить поле

### `__construct()` <a name="__construct"></a>

Конструктор

#### Сигнатура

- **public** method.
- Может принимать следующий параметр(ы):
    - `$settings` (`array`) - настройки объекта
- Ничего не возвращает.
- Выбрасывает одно из следующих исключений:
    - [`avtomon\FieldException`](../avtomon/FieldException.md)
    - [`avtomon\VariantException`](../avtomon/VariantException.md)
    - [`ReflectionException`](http://php.net/class.ReflectionException)

### `setFieldWrapper()` <a name="setFieldWrapper"></a>

Установить обертку поля

#### Сигнатура

- **public** method.
- Может принимать следующий параметр(ы):
    - `$fieldWrapper` ([`FieldWrapper`](../avtomon/FieldWrapper.md)) - объект обертки
- Ничего не возвращает.

### `setTemplate()` <a name="setTemplate"></a>

Установить шаблон поля

#### Сигнатура

- **public** method.
- Может принимать следующий параметр(ы):
    - `$template` (`string`)
- Ничего не возвращает.

### `setType()` <a name="setType"></a>

Установить тип поля

#### Сигнатура

- **public** method.
- Может принимать следующий параметр(ы):
    - `$type` (`string`) - тип
- Ничего не возвращает.
- Выбрасывает одно из следующих исключений:
    - [`avtomon\FieldException`](../avtomon/FieldException.md)

### `setOptions()` <a name="setOptions"></a>

Установить элементы выпадающего списка

#### Сигнатура

- **public** method.
- Может принимать следующий параметр(ы):
    - `$options` (`array`) - список объектов элементов
- Ничего не возвращает.

### `setVariants()` <a name="setVariants"></a>

Установить варианты выбора переключателя

#### Сигнатура

- **public** method.
- Может принимать следующий параметр(ы):
    - `$variants` (`array`) - список объектов вариантов
- Ничего не возвращает.

### `addVariant()` <a name="addVariant"></a>

Добавить вариант выбора переключателя

#### Сигнатура

- **public** method.
- Может принимать следующий параметр(ы):
    - `$variant` ([`Variant`](../avtomon/Variant.md)) - добавляемый вариант
- Ничего не возвращает.

### `setValue()` <a name="setValue"></a>

Установить значение поля

#### Сигнатура

- **public** method.
- Может принимать следующий параметр(ы):
    - `$value` - значение
- Ничего не возвращает.

### `setText()` <a name="setText"></a>

Установить имя поля

#### Сигнатура

- **public** method.
- Может принимать следующий параметр(ы):
    - `$name` - имя
- Ничего не возвращает.

### `setLabelText()` <a name="setLabelText"></a>

Установить текст метки поля

#### Сигнатура

- **public** method.
- Может принимать следующий параметр(ы):
    - `$labelText` - текст
- Ничего не возвращает.

### `setEmptyText()` <a name="setEmptyText"></a>

Установить текст пустого элемента списка

#### Сигнатура

- **public** method.
- Может принимать следующий параметр(ы):
    - `$emptyText` - текст
- Ничего не возвращает.

### `setTemplatePath()` <a name="setTemplatePath"></a>

Установить путь до директории с шаблонами полей

#### Сигнатура

- **public** method.
- Может принимать следующий параметр(ы):
    - `$templatePath` (`string`) - путь
- Ничего не возвращает.

### `setSelectedValue()` <a name="setSelectedValue"></a>

Установить значение элемента списка, выбираемого по умолчанию

#### Сигнатура

- **public** method.
- Может принимать следующий параметр(ы):
    - `$selectedValue` - значение
- Ничего не возвращает.

### `addOption()` <a name="addOption"></a>

Добавить элемент выпадающего списка

#### Сигнатура

- **public** method.
- Может принимать следующий параметр(ы):
    - `$option` ([`Option`](../avtomon/Option.md)) - объект элемента списка
- Ничего не возвращает.

### `getName()` <a name="getName"></a>

Вернуть имя поля

#### Сигнатура

- **public** method.
- Возвращает `string` value.

### `getType()` <a name="getType"></a>

Вренуть тип поля

#### Сигнатура

- **public** method.
- Возвращает `string` value.

### `getAttribute()` <a name="getAttribute"></a>

Вернуть значение атрибута, если такой есть

#### Сигнатура

- **public** method.
- Может принимать следующий параметр(ы):
    - `$name` (`string`) - имя искомого атрибута
- Возвращает `mixed` value.

### `renderSelect()` <a name="renderSelect"></a>

Отрендерить поле выпадающего списка

#### Сигнатура

- **protected** method.
- Может возвращать одно из следующих значений:
    - `avtomon\false`
    - `null`
    - `phpQueryObject`
    - `QueryTemplatesParse`
    - `QueryTemplatesPhpQuery`
    - `QueryTemplatesSource`
    - `QueryTemplatesSourceQuery`
    - `String`
- Выбрасывает одно из следующих исключений:
    - [`Exception`](http://php.net/class.Exception)

### `renderFieldHint()` <a name="renderFieldHint"></a>

Отрендерить подсказку поля

#### Сигнатура

- **protected** method.
- Может возвращать одно из следующих значений:
    - `avtomon\false`
    - `null`
    - `phpQueryObject`
    - `QueryTemplatesParse`
    - `QueryTemplatesPhpQuery`
    - `QueryTemplatesSource`
    - `QueryTemplatesSourceQuery`
    - `String`
- Выбрасывает одно из следующих исключений:
    - [`Exception`](http://php.net/class.Exception)

### `renderLabel()` <a name="renderLabel"></a>

Рендеринг метки поля

#### Сигнатура

- **protected** method.
- Может возвращать одно из следующих значений:
    - `null`
    - `phpQueryObject`
    - `QueryTemplatesParse`
    - `QueryTemplatesPhpQuery`
    - `QueryTemplatesSource`
    - `QueryTemplatesSourceQuery`
- Выбрасывает одно из следующих исключений:
    - [`Exception`](http://php.net/class.Exception)

### `getRenderedTemplate()` <a name="getRenderedTemplate"></a>

Отрендерить поле представленное шаблоном

#### Сигнатура

- **public** method.
- Может возвращать одно из следующих значений:
    - `avtomon\false`
    - `null`
    - `phpQueryObject`
    - `QueryTemplatesParse`
    - `QueryTemplatesPhpQuery`
    - `QueryTemplatesSource`
    - `QueryTemplatesSourceQuery`
- Выбрасывает одно из следующих исключений:
    - [`Exception`](http://php.net/class.Exception)

### `renderInput()` <a name="renderInput"></a>

Отрендерить однострочное поле ввода

#### Сигнатура

- **protected** method.
- Может возвращать одно из следующих значений:
    - `avtomon\false`
    - `null`
    - `phpQueryObject`
    - `QueryTemplatesParse`
    - `QueryTemplatesPhpQuery`
    - `QueryTemplatesSource`
    - `QueryTemplatesSourceQuery`
    - `String`
- Выбрасывает одно из следующих исключений:
    - [`Exception`](http://php.net/class.Exception)

### `renderHidden()` <a name="renderHidden"></a>

Отрендерить скрытое поле ввода

#### Сигнатура

- **protected** method.
- Может возвращать одно из следующих значений:
    - `avtomon\false`
    - `null`
    - `phpQueryObject`
    - `QueryTemplatesParse`
    - `QueryTemplatesPhpQuery`
    - `QueryTemplatesSource`
    - `QueryTemplatesSourceQuery`
    - `String`
- Выбрасывает одно из следующих исключений:
    - [`Exception`](http://php.net/class.Exception)

### `renderSwitch()` <a name="renderSwitch"></a>

Отрендерить переключатель

#### Сигнатура

- **protected** method.
- Может возвращать одно из следующих значений:
    - `null`
    - `phpQueryObject`
    - `QueryTemplatesParse`
    - `QueryTemplatesPhpQuery`
    - `QueryTemplatesSource`
    - `QueryTemplatesSourceQuery`
    - `string`
- Выбрасывает одно из следующих исключений:
    - [`Exception`](http://php.net/class.Exception)

### `renderTextarea()` <a name="renderTextarea"></a>

Отрендерить многострочное поле ввода

#### Сигнатура

- **protected** method.
- Может возвращать одно из следующих значений:
    - `avtomon\false`
    - `null`
    - `phpQueryObject`
    - `QueryTemplatesParse`
    - `QueryTemplatesPhpQuery`
    - `QueryTemplatesSource`
    - `QueryTemplatesSourceQuery`
    - `String`
- Выбрасывает одно из следующих исключений:
    - [`Exception`](http://php.net/class.Exception)

### `render()` <a name="render"></a>

Отрендерить поле

#### Сигнатура

- **public** method.
- Возвращает `mixed` value.
- Выбрасывает одно из следующих исключений:
    - [`Exception`](http://php.net/class.Exception)

