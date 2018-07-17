<small> avtomon </small>

Section
=======

Class of form partitions

Description
-----------

Class Section

Signature
---------

- **class**.
- It is a subclass of the class [`AbstractFormComponent`](../avtomon/AbstractFormComponent.md).

Properties
----------

class sets the following properties:

  - [`$title`](#$title) &mdash; Form section title
  - [`$fields`](#$fields) &mdash; Partition fields
  - [`$buttons`](#$buttons) &mdash; Partition Buttons
  - [`$id`](#$id) &mdash; Partition identifier

### `$title`<a name="title"> </a>

Form section title

#### Signature

- **protected** property.
- The value of `string`.

### `$fields`<a name="fields"> </a>

Partition fields

#### Signature

- **protected** property.
- The value of `array`.

### `$buttons`<a name="buttons"> </a>

Partition Buttons

#### Signature

- **protected** property.
- The value of `array`.

### `$id`<a name="id"> </a>

Partition identifier

#### Signature

- **protected** property.
- The value of `string`.

Methods
-------

Class methods class:

  - [`__construct()`](#__construct) &mdash; Constructor
  - [`setFields()`](#setFields) &mdash; Set partition fields
  - [`addField()`](#addField) &mdash; Add a field to the section
  - [`appendField()`](#appendField) &mdash; Add a field to the end of the section
- [prependField() `](#prependField) &mdash; Add a field to the beginning of the section
  - [`deleteField()`](#deleteField) &mdash; Delete the section field by name
  - [`setButtons()`](#setButtons) &mdash; Set partition buttons
  - [`addButton()`](#addButton) &mdash; Add a folder to the section
  - [`setTitle()`](#setTitle) &mdash; Set section title
  - [`render()`](#render) &mdash; To render the form section
  - [`getFields()`](#getFields) &mdash; Revert section fields
  - [`getTitle()`](#getTitle) &mdash; Revert section title
  - [`getId()`](#getId) &mdash; Return partition ID

### `__construct()`<a name="__construct"> </a>

Constructor

#### Signature

- **public** method.
- It can take the following parameter (s):
  - `$settings`(`array`) - object settings
- Returns nothing.
- Throws one of the following exceptions:
  - [`avtomon\FieldException`](../avtomon/FieldException.md)
  - [`avtomon\VariantException`](../avtomon/VariantException.md)
  - [`ReflectionException`](http://php.net/class.ReflectionException)

### `setFields()`<a name="setFields"> </a>

Set partition fields

#### Signature

- **public** method.
- It can take the following parameter (s):
  - `$fields`(`array`) - list of fields
- Returns nothing.

### `addField()`<a name="addField"> </a>

Add a field to the section

#### Signature

- **public** method.
- It can take the following parameter (s):
  - `$field`([`Field`](../avtomon/Field.md)) - field object
  - `$isAppend`(`bool`) - add a field to the end and to the beginning of the section
- Returns nothing.

### `appendField()`<a name="appendField"> </a>

Add a field to the end of the section

#### Signature

- **public** method.
- It can take the following parameter (s):
  - `$field`([`Field`](../avtomon/Field.md)) - field object
- Returns nothing.

### `prependField()`<a name="prependField"> </a>

Add a field to the beginning of the section

#### Signature

- **public** method.
- It can take the following parameter (s):
  - `$field`([`Field`](../avtomon/Field.md)) - field object
- Returns nothing.

### `deleteField()`<a name="deleteField"> </a>

Delete the section field by name

#### Signature

- **public** method.
- It can take the following parameter (s):
  - `$field`([`Field`](../avtomon/Field.md)) - the field to be deleted
- Returns nothing.

### `setButtons()`<a name="setButtons"> </a>

Set partition buttons

#### Signature

- **public** method.
- It can take the following parameter (s):
  - `$buttons`(`array`) - array of buttons
- Returns nothing.

### `addButton()`<a name="addButton"> </a>

Add a folder to the section

#### Signature

- **public** method.
- It can take the following parameter (s):
  - `$button`([`Button`](../avtomon/Button.md)) - button object
- Returns nothing.

### `setTitle()`<a name="setTitle"> </a>

Set section title

#### Signature

- **public** method.
- It can take the following parameter (s):
  - `$title`(`string`) - a new title
- Returns nothing.

### `render()`<a name="render"> </a>

To render the form section

#### Signature

- **public** method.
Returns the `mixed`value.
- Throws one of the following exceptions:
  - [`Exception`](http://php.net/class.Exception)

### `getFields()`<a name="getFields"> </a>

Revert section fields

#### Signature

- **public** method.
Returns the `array`value.

### `getTitle()`<a name="getTitle"> </a>

Revert section title

#### Signature

- **public** method.
Returns `string`value.

### `getId()`<a name="getId"> </a>

Return partition ID

#### Signature

- **public** method.
Returns `string`value.

