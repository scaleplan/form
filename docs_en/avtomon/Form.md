<small> avtomon </small>

Form
====

Form class

Description
-----------

Class Form

Signature
---------

- **class**.

Constants
---------

class sets the following constants:

  - [`ADDITIONAL_FIELDS_SECTION_NUMBER`](#ADDITIONAL_FIELDS_SECTION_NUMBER) &mdash; In which section to add the additional generated fields of the form

Properties
----------

class sets the following properties:

  - [`$formConf`](#$formConf) &mdash; Form configuration
  - [`$title`](#$title) &mdash; Form caption settings
  - [`$menu`](#$menu) &mdash; Menu settings
  - [`$form`](#$form) &mdash; Form Usage
  - [`$selectValueFieldName`](#$selectValueFieldName) &mdash; The name of the field containing the value & lt; option & gt;
  - [`$selectTextFieldName`](#$selectTextFieldName) &mdash; The name of the field containing the & lt; option & gt;
  - [`$stopImageClass`](#$stopImageClass) &mdash; Image class displaying no pictures
  - [`$filePathKey`](#$filePathKey) &mdash; The index of the path to the file in the file array,
  - [`$filePosterKey`](#$filePosterKey) &mdash; The index of the path to the poster of the file (if any) in the file array
  - [`$fileNameKey`](#$fileNameKey) &mdash; Indesk of the original file name in the file array
  - [`$fileNamePrefix`](#$fileNamePrefix) &mdash; Prefix for files that have been uploaded to the form, previously saved files
  - [`$sections`](#$sections) &mdash; Form field partitions
  - [`$fields`](#$fields) &mdash; Form fields (outside sections)
  - [`$additionalFields`](#$additionalFields) &mdash; Additionally generated form fields

### `$formConf`<a name="formConf"> </a>

Form configuration

#### Signature

- **protected** property.
- The value of `array`.

### `$title`<a name="title"> </a>

Form caption settings

#### Signature

- **protected** property.
- The value of `array`.

### `$menu`<a name="menu"> </a>

Menu settings

#### Signature

- **protected** property.
- The value of `array`.

### `$form`<a name="form"> </a>

Form Usage

#### Signature

- **protected** property.
- The value of `array`.

### `$selectValueFieldName`<a name="selectValueFieldName"> </a>

The name of the field containing the value <option>

#### Signature

- **protected** property.
- The value of `string`.

### `$selectTextFieldName`<a name="selectTextFieldName"> </a>

The name of the field containing the <option>

#### Signature

- **protected** property.
- The value of `string`.

### `$stopImageClass`<a name="stopImageClass"> </a>

Image class displaying no pictures

#### Signature

- **protected** property.
- The value of `string`.

### `$filePathKey`<a name="filePathKey"> </a>

The index of the path to the file in the file array,

#### Signature

- **protected** property.
- The value of `string`.

### `$filePosterKey`<a name="filePosterKey"> </a>

The index of the path to the poster of the file (if any) in the file array

#### Signature

- **protected** property.
- The value of `string`.

### `$fileNameKey`<a name="fileNameKey"> </a>

Indesk of the original file name in the file array

#### Signature

- **protected** property.
- The value of `string`.

### `$fileNamePrefix`<a name="fileNamePrefix"> </a>

Prefix for files that have been uploaded to the form, previously saved files

#### Signature

- **protected** property.
- The value of `string`.

### `$sections`<a name="sections"> </a>

Form field partitions

#### Signature

- **protected** property.
- The value of `array`.

### `$fields`<a name="fields"> </a>

Form fields (outside sections)

#### Signature

- **protected** property.
- The value of `array`.

### `$additionalFields`<a name="additionalFields"> </a>

Additionally generated form fields

#### Signature

- **protected** property.
- The value of `array`.

Methods
-------

Class methods class:

  - [`__construct()`](#__construct) &mdash; Constructor
  - [`setForm()`](#setForm) &mdash; Set Form Settings
  - [`setSections()`](#setSections) &mdash; Set Form Partitions
  - [`addSection()`](#addSection) &mdash; Add Form Section
  - [`addField()`](#addField) &mdash; Add Field to Form
  - [`appendField()`](#appendField) &mdash; Add a field to the form at the end of the section
- [prependField() `](#prependField) &mdash; Add a field to the form at the beginning of the section
  - [`setFields()`](#setFields) &mdash; Set form fields
  - [`render()`](#render) &mdash; Turn the form into HTML markup
  - [`setFormValues ​​()`](#setFormValues) &mdash; Fill out form fields with values
  - [`setImageValue()`](#setImageValue) &mdash; Inserting images
  - [`setFileValue()`](#setFileValue) &mdash; Inserting images
  - [`setSelectOptions()`](#setSelectOptions) &mdash; Set options for the drop-down list
  - [`setFormAction()`](#setFormAction) &mdash; Set the action parameter of the form
  - [`getFormConf()`](#getFormConf) &mdash; Return config config
  - [`__toString()`](#__toString) &mdash; Return an object as a string
  - [`getTitleText()`](#getTitleText) &mdash; Return form header text
  - [`setTitleText()`](#setTitleText) &mdash; Setting the Form Header Text

### `__construct()`<a name="__construct"> </a>

Constructor

#### Signature

- **public** method.
- It can take the following parameter (s):
  - `$formConf`(`array`) - configuration parameters
- Returns nothing.
- Throws one of the following exceptions:
  - [`avtomon\FieldException`](../avtomon/FieldException.md)
  - [`avtomon\VariantException`](../avtomon/VariantException.md)
  - [`ReflectionException`](http://php.net/class.ReflectionException)

### `setForm()`<a name="setForm"> </a>

Set Form Settings

#### Signature

- **public** method.
- It can take the following parameter (s):
  - `$form`(`array`) - form settings
- Returns nothing.

### `setSections()`<a name="setSections"> </a>

Set Form Partitions

#### Signature

- **public** method.
- It can take the following parameter (s):
  - `$sections`(`array`)
- Returns nothing.

### `addSection()`<a name="addSection"> </a>

Add Form Section

#### Signature

- **public** method.
- It can take the following parameter (s):
  - `$section`([`Section`](../avtomon/Section.md))
- Returns nothing.

### `addField()`<a name="addField"> </a>

Add Field to Form

#### Signature

- **public** method.
- It can take the following parameter (s):
  - `$field`([`Field`](../avtomon/Field.md)) - the field to add
  - `$sectionNumber`(`int`) - the number of the section of the form in which to add the field
  - `$isAppend`(`bool`) - add a field to the end and to the beginning of the section
- Returns [`Form`](../avtomon/Form.md) value.
- Throws one of the following exceptions:
  - [`avtomon\FormException`](../avtomon/FormException.md)

### `appendField()`<a name="appendField"> </a>

Add a field to the form at the end of the section

#### Signature

- **public** method.
- It can take the following parameter (s):
  - `$field`([`Field`](../avtomon/Field.md)) - the field to add
  - `$sectionNumber`(`int`) - the number of the section of the form in which to add the field
- Returns [`Form`](../avtomon/Form.md) value.
- Throws one of the following exceptions:
  - [`avtomon\FormException`](../avtomon/FormException.md)

### `prependField()`<a name="prependField"> </a>

Add a field to the form at the beginning of the section

#### Signature

- **public** method.
- It can take the following parameter (s):
  - `$field`([`Field`](../avtomon/Field.md)) - the field to add
  - `$sectionNumber`(`int`) - the number of the section of the form in which to add the field
- Returns [`Form`](../avtomon/Form.md) value.
- Throws one of the following exceptions:
  - [`avtomon\FormException`](../avtomon/FormException.md)

### `setFields()`<a name="setFields"> </a>

Set form fields

#### Signature

- **public** method.
- It can take the following parameter (s):
  - `$fields`(`array`)
- Returns nothing.

### `render()`<a name="render"> </a>

Turn the form into HTML markup

#### Signature

- **public** method.
- Can return one of the following values:
  - `phpQueryObject`
  - `QueryTemplatesParse`
  - `QueryTemplatesSource`
  - `QueryTemplatesSourceQuery`
  - `string`
- Throws one of the following exceptions:
  - [`Exception`](http://php.net/class.Exception)

### `setFormValues ​​()`<a name="setFormValues"> </a>

Fill out form fields with values

#### Signature

- **public** method.
- It can take the following parameter (s):
  - `$valuesObject`(`array`) - an array of values ​​in the format & lt; field name & gt; = & gt; & lt; value & gt;
- Returns nothing.
- Throws one of the following exceptions:
  - [`avtomon\FieldException`](../avtomon/FieldException.md)
  - [`avtomon\VariantException`](../avtomon/VariantException.md)
  - [`ReflectionException`](http://php.net/class.ReflectionException)

### `setImageValue()`<a name="setImageValue"> </a>

Inserting images

#### Signature

- **protected** method.
- It can take the following parameter (s):
  - `$field`([`Field`](../avtomon/Field.md)) - reference field
  - `$value`(`string`) - image or array of images
- Can return one of the following values:
  - `null`
  - `phpQueryObject`
  - `QueryTemplatesParse`
  - `QueryTemplatesSource`
  - `QueryTemplatesSourceQuery`
- Throws one of the following exceptions:
  - [`Exception`](http://php.net/class.Exception)

### `setFileValue()`<a name="setFileValue"> </a>

Inserting images

#### Signature

- **protected** method.
- It can take the following parameter (s):
  - `$field`([`Field`](../avtomon/Field.md)) - reference field
  - `$value`- image or image array
- Can return one of the following values:
  - [`Field`](../avtomon/Field.md)
  - `null`
- Throws one of the following exceptions:
  - [`avtomon\FieldException`](../avtomon/FieldException.md)
  - [`avtomon\VariantException`](../avtomon/VariantException.md)
  - [`ReflectionException`](http://php.net/class.ReflectionException)
  - [`Exception`](http://php.net/class.Exception)

### `setSelectOptions()`<a name="setSelectOptions"> </a>

Set options for the drop-down list

#### Signature

- **public** method.
- It can take the following parameter (s):
  - `$selectName`(`string`) - list name
  - `$options`(`array`) - list items
  - `$emptyText`(`null`) - the text of the empty item
  - `$selectedValue`(`null`) - the default element
- Can return one of the following values:
  - [`Field`](../avtomon/Field.md)
  - `null`

### `setFormAction()`<a name="setFormAction"> </a>

Set the action parameter of the form

#### Signature

- **public** method.
- It can take the following parameter (s):
  - `$newAction`(`string`) - the new value of the action
- Returns nothing.

### `getFormConf()`<a name="getFormConf"> </a>

Return config config

#### Signature

- **public** method.
Returns the `array`value.

### `__toString()`<a name="__toString"> </a>

Return an object as a string

#### Signature

- **public** method.
Returns `string`value.
- Throws one of the following exceptions:
  - [`Exception`](http://php.net/class.Exception)

### `getTitleText()`<a name="getTitleText"> </a>

Return form header text

#### Signature

- **public** method.
Returns `string`value.

### `setTitleText()`<a name="setTitleText"> </a>

Setting the Form Header Text

#### Signature

- **public** method.
- It can take the following parameter (s):
  - `$newText`(`string`)
- Returns nothing.

