<small> avtomon </small>

Option
======

Class of drop-down list items

Description
-----------

Class Option

Signature
---------

- **class**.
- It is a subclass of the class [`AbstractFormComponent`](../avtomon/AbstractFormComponent.md).

Properties
----------

class sets the following properties:

  - [`$text`](#$text) &mdash; List item text
  - [`$value`](#$value) &mdash; List Item Value

### `$text`<a name="text"> </a>

List item text

#### Signature

- **protected** property.
- The value of `string`.

### `$value`<a name="value"> </a>

List Item Value

#### Signature

- **protected** property.
- The value of `string`.

Methods
-------

Class methods class:

  - [`getText()`](#getText) &mdash; Return list item text
  - [`getValue()`](#getValue) &mdash; Return the value of a list item
  - [`setValue()`](#setValue) &mdash; Set the value of a list item
  - [`setText()`](#setText) &mdash; Set list item text
  - [`render()`](#render) &mdash; To render a list item

### `getText()`<a name="getText"> </a>

Return list item text

#### Signature

- **public** method.
Returns `string`value.

### `getValue()`<a name="getValue"> </a>

Return the value of a list item

#### Signature

- **public** method.
Returns `string`value.

### `setValue()`<a name="setValue"> </a>

Set the value of a list item

#### Signature

- **public** method.
- It can take the following parameter (s):
  - `$value`- value
- Returns nothing.

### `setText()`<a name="setText"> </a>

Set list item text

#### Signature

- **public** method.
- It can take the following parameter (s):
  - `$text`- text
- Returns nothing.

### `render()`<a name="render"> </a>

To render a list item

#### Signature

- **public** method.
Returns the `mixed`value.
- Throws one of the following exceptions:
  - [`Exception`](http://php.net/class.Exception)

