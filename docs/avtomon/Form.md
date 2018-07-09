<small>avtomon</small>

Form
====

Класс формы

Описание
-----------

Class Form

Сигнатура
---------

- **class**.

Константы
---------

class устанавливает следующие константы:

- [`ADDITIONAL_FIELDS_SECTION_NUMBER`](#ADDITIONAL_FIELDS_SECTION_NUMBER) &mdash; В какой раздел добавлять дополнительно сгенерированные поля формы

Свойства
----------

class устанавливает следующие свойства:

- [`$formConf`](#$formConf) &mdash; Конфигурация формы
- [`$title`](#$title) &mdash; Настройки заголовка формы
- [`$menu`](#$menu) &mdash; Настройки меню
- [`$form`](#$form) &mdash; Настроки формы
- [`$selectValueFieldName`](#$selectValueFieldName) &mdash; Имя поля содержащего значение &lt;option&gt;
- [`$selectTextFieldName`](#$selectTextFieldName) &mdash; Имя поля содержащего тектс &lt;option&gt;
- [`$stopImageClass`](#$stopImageClass) &mdash; Класс картинки отображающей отсутствие картинок
- [`$filePathKey`](#$filePathKey) &mdash; Индекс пути к файлу в массиве файлов,
- [`$filePosterKey`](#$filePosterKey) &mdash; Индекс пути к постеру файла (если есть) в массиве файлов
- [`$fileNameKey`](#$fileNameKey) &mdash; Индеск изначального имени файла в массиве файлов
- [`$fileNamePrefix`](#$fileNamePrefix) &mdash; Префикс для подгжужаемых в форму, ранее сохраненных файлов
- [`$sections`](#$sections) &mdash; Разделы полей формы
- [`$fields`](#$fields) &mdash; Поля формы (вне разделов)
- [`$additionalFields`](#$additionalFields) &mdash; Дополнительно сгенерированные поля формы

### `$formConf` <a name="formConf"></a>

Конфигурация формы

#### Сигнатура

- **protected** property.
- Значение `array`.

### `$title` <a name="title"></a>

Настройки заголовка формы

#### Сигнатура

- **protected** property.
- Значение `array`.

### `$menu` <a name="menu"></a>

Настройки меню

#### Сигнатура

- **protected** property.
- Значение `array`.

### `$form` <a name="form"></a>

Настроки формы

#### Сигнатура

- **protected** property.
- Значение `array`.

### `$selectValueFieldName` <a name="selectValueFieldName"></a>

Имя поля содержащего значение <option>

#### Сигнатура

- **protected** property.
- Значение `string`.

### `$selectTextFieldName` <a name="selectTextFieldName"></a>

Имя поля содержащего тектс <option>

#### Сигнатура

- **protected** property.
- Значение `string`.

### `$stopImageClass` <a name="stopImageClass"></a>

Класс картинки отображающей отсутствие картинок

#### Сигнатура

- **protected** property.
- Значение `string`.

### `$filePathKey` <a name="filePathKey"></a>

Индекс пути к файлу в массиве файлов,

#### Сигнатура

- **protected** property.
- Значение `string`.

### `$filePosterKey` <a name="filePosterKey"></a>

Индекс пути к постеру файла (если есть) в массиве файлов

#### Сигнатура

- **protected** property.
- Значение `string`.

### `$fileNameKey` <a name="fileNameKey"></a>

Индеск изначального имени файла в массиве файлов

#### Сигнатура

- **protected** property.
- Значение `string`.

### `$fileNamePrefix` <a name="fileNamePrefix"></a>

Префикс для подгжужаемых в форму, ранее сохраненных файлов

#### Сигнатура

- **protected** property.
- Значение `string`.

### `$sections` <a name="sections"></a>

Разделы полей формы

#### Сигнатура

- **protected** property.
- Значение `array`.

### `$fields` <a name="fields"></a>

Поля формы (вне разделов)

#### Сигнатура

- **protected** property.
- Значение `array`.

### `$additionalFields` <a name="additionalFields"></a>

Дополнительно сгенерированные поля формы

#### Сигнатура

- **protected** property.
- Значение `array`.

Методы
-------

Методы класса class:

- [`__construct()`](#__construct) &mdash; Конструктор
- [`setForm()`](#setForm) &mdash; Установить настройки формы
- [`setSections()`](#setSections) &mdash; Установить разделы формы
- [`addSection()`](#addSection) &mdash; Добавить раздел формы
- [`addField()`](#addField) &mdash; Добавить поле к форме
- [`appendField()`](#appendField) &mdash; Добавить поле к форме в конец раздела
- [`prependField()`](#prependField) &mdash; Добавить поле к форме в начало раздела
- [`setFields()`](#setFields) &mdash; Установить поля формы
- [`render()`](#render) &mdash; Превратить форму в HTML-разметку
- [`setFormValues()`](#setFormValues) &mdash; Заполняить поля форма значениями
- [`setImageValue()`](#setImageValue) &mdash; Вставка изображений
- [`setFileValue()`](#setFileValue) &mdash; Вставка изображений
- [`setSelectOptions()`](#setSelectOptions) &mdash; Установить опции для выпадающего списка
- [`setFormAction()`](#setFormAction) &mdash; Установить параметр action формы
- [`getFormConf()`](#getFormConf) &mdash; Вернуть конфиг формы
- [`__toString()`](#__toString) &mdash; Вернуть объект в виде строки
- [`getTitleText()`](#getTitleText) &mdash; Вернуть текст заголовка формы
- [`setTitleText()`](#setTitleText) &mdash; Установка текста заголовка формы

### `__construct()` <a name="__construct"></a>

Конструктор

#### Сигнатура

- **public** method.
- Может принимать следующий параметр(ы):
    - `$formConf` (`array`) &mdash; - параметры конфигурации
- Ничего не возвращает.
- Выбрасывает одно из следующих исключений:
    - [`avtomon\FieldException`](../avtomon/FieldException.md)
    - [`avtomon\VariantException`](../avtomon/VariantException.md)
    - [`ReflectionException`](http://php.net/class.ReflectionException)

### `setForm()` <a name="setForm"></a>

Установить настройки формы

#### Сигнатура

- **public** method.
- Может принимать следующий параметр(ы):
    - `$form` (`array`) &mdash; - настройки формы
- Ничего не возвращает.

### `setSections()` <a name="setSections"></a>

Установить разделы формы

#### Сигнатура

- **public** method.
- Может принимать следующий параметр(ы):
    - `$sections` (`array`)
- Ничего не возвращает.

### `addSection()` <a name="addSection"></a>

Добавить раздел формы

#### Сигнатура

- **public** method.
- Может принимать следующий параметр(ы):
    - `$section` ([`Section`](../avtomon/Section.md))
- Ничего не возвращает.

### `addField()` <a name="addField"></a>

Добавить поле к форме

#### Сигнатура

- **public** method.
- Может принимать следующий параметр(ы):
    - `$field` ([`Field`](../avtomon/Field.md)) &mdash; - добавляемое поле
    - `$sectionNumber` (`int`) &mdash; - номер раздела формы, в который добавлять поле
    - `$isAppend` (`bool`) &mdash; - добавлять поле в конец и в начала раздела
- Возвращает [`Form`](../avtomon/Form.md) value.
- Выбрасывает одно из следующих исключений:
    - [`avtomon\FormException`](../avtomon/FormException.md)

### `appendField()` <a name="appendField"></a>

Добавить поле к форме в конец раздела

#### Сигнатура

- **public** method.
- Может принимать следующий параметр(ы):
    - `$field` ([`Field`](../avtomon/Field.md)) &mdash; - добавляемое поле
    - `$sectionNumber` (`int`) &mdash; - номер раздела формы, в который добавлять поле
- Возвращает [`Form`](../avtomon/Form.md) value.
- Выбрасывает одно из следующих исключений:
    - [`avtomon\FormException`](../avtomon/FormException.md)

### `prependField()` <a name="prependField"></a>

Добавить поле к форме в начало раздела

#### Сигнатура

- **public** method.
- Может принимать следующий параметр(ы):
    - `$field` ([`Field`](../avtomon/Field.md)) &mdash; - добавляемое поле
    - `$sectionNumber` (`int`) &mdash; - номер раздела формы, в который добавлять поле
- Возвращает [`Form`](../avtomon/Form.md) value.
- Выбрасывает одно из следующих исключений:
    - [`avtomon\FormException`](../avtomon/FormException.md)

### `setFields()` <a name="setFields"></a>

Установить поля формы

#### Сигнатура

- **public** method.
- Может принимать следующий параметр(ы):
    - `$fields` (`array`)
- Ничего не возвращает.

### `render()` <a name="render"></a>

Превратить форму в HTML-разметку

#### Сигнатура

- **public** method.
- Может возвращать одно из следующих значений:
    - `phpQueryObject`
    - `QueryTemplatesParse`
    - `QueryTemplatesSource`
    - `QueryTemplatesSourceQuery`
    - `string`
- Выбрасывает одно из следующих исключений:
    - [`Exception`](http://php.net/class.Exception)

### `setFormValues()` <a name="setFormValues"></a>

Заполняить поля форма значениями

#### Сигнатура

- **public** method.
- Может принимать следующий параметр(ы):
    - `$valuesObject` (`array`) &mdash; - массив значений в формате &lt;имя поля&gt; =&gt; &lt;значение&gt;
- Ничего не возвращает.
- Выбрасывает одно из следующих исключений:
    - [`avtomon\FieldException`](../avtomon/FieldException.md)
    - [`avtomon\VariantException`](../avtomon/VariantException.md)
    - [`ReflectionException`](http://php.net/class.ReflectionException)

### `setImageValue()` <a name="setImageValue"></a>

Вставка изображений

#### Сигнатура

- **protected** method.
- Может принимать следующий параметр(ы):
    - `$field` ([`Field`](../avtomon/Field.md)) &mdash; - поле-эталон
    - `$value` (`string`) &mdash; - изображение или массив изображений
- Может возвращать одно из следующих значений:
    - `null`
    - `phpQueryObject`
    - `QueryTemplatesParse`
    - `QueryTemplatesSource`
    - `QueryTemplatesSourceQuery`
- Выбрасывает одно из следующих исключений:
    - [`Exception`](http://php.net/class.Exception)

### `setFileValue()` <a name="setFileValue"></a>

Вставка изображений

#### Сигнатура

- **protected** method.
- Может принимать следующий параметр(ы):
    - `$field` ([`Field`](../avtomon/Field.md)) &mdash; - поле-эталон
    - `$value` &mdash; - изображение или массив изображений
- Может возвращать одно из следующих значений:
    - [`Field`](../avtomon/Field.md)
    - `null`
- Выбрасывает одно из следующих исключений:
    - [`avtomon\FieldException`](../avtomon/FieldException.md)
    - [`avtomon\VariantException`](../avtomon/VariantException.md)
    - [`ReflectionException`](http://php.net/class.ReflectionException)
    - [`Exception`](http://php.net/class.Exception)

### `setSelectOptions()` <a name="setSelectOptions"></a>

Установить опции для выпадающего списка

#### Сигнатура

- **public** method.
- Может принимать следующий параметр(ы):
    - `$selectName` (`string`) &mdash; - имя списка
    - `$options` (`array`) &mdash; - элементы списка
    - `$emptyText` (`null`) &mdash; - текст пустого пункта
    - `$selectedValue` (`null`) &mdash; - элемент по умолчанию
- Может возвращать одно из следующих значений:
    - [`Field`](../avtomon/Field.md)
    - `null`

### `setFormAction()` <a name="setFormAction"></a>

Установить параметр action формы

#### Сигнатура

- **public** method.
- Может принимать следующий параметр(ы):
    - `$newAction` (`string`) &mdash; - новое значение action
- Ничего не возвращает.

### `getFormConf()` <a name="getFormConf"></a>

Вернуть конфиг формы

#### Сигнатура

- **public** method.
- Возвращает `array` value.

### `__toString()` <a name="__toString"></a>

Вернуть объект в виде строки

#### Сигнатура

- **public** method.
- Возвращает `string` value.
- Выбрасывает одно из следующих исключений:
    - [`Exception`](http://php.net/class.Exception)

### `getTitleText()` <a name="getTitleText"></a>

Вернуть текст заголовка формы

#### Сигнатура

- **public** method.
- Возвращает `string` value.

### `setTitleText()` <a name="setTitleText"></a>

Установка текста заголовка формы

#### Сигнатура

- **public** method.
- Может принимать следующий параметр(ы):
    - `$newText` (`string`)
- Ничего не возвращает.

