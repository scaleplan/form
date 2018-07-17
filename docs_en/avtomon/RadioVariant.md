<small> avtomon </small>

RadioVariant
============

Signature
---------

- **class**.
- It is a subclass of the class [`AbstractFormComponent`](../avtomon/AbstractFormComponent.md).

Properties
----------

class sets the following properties:

  - [`$labelText`](#$labelText) &mdash; Switch option text
  - [`$name`](#$name) &mdash; Switch name
  - [`$value`](#$value) &mdash; Switch Variation Value

### `$labelText`<a name="labelText"> </a>

Switch option text

#### Signature

- **protected** property.
- The value of `string`.

### `$name`<a name="name"> </a>

Switch name

#### Signature

- **protected** property.
- The value of `string`.

### `$value`<a name="value"> </a>

Switch Variation Value

#### Signature

- **protected** property.
- The value of `string`.

Methods
-------

Class methods class:

  - [`__construct()`](#__construct) &mdash; Constructor
  - [`render()`](#render) &mdash; To render the switch option
  - [`getValue()`](#getValue) &mdash; Return the value of the switch

### `__construct()`<a name="__construct"> </a>

Constructor

#### Signature

- **public** method.
- It can take the following parameter (s):
  - `$settings`(`array`) - object settings
- Returns nothing.
- Throws one of the following exceptions:
  - [`avtomon\SectionException`](../avtomon/SectionException.md)

### `render()`<a name="render"> </a>

To render the switch option

#### Signature

- **public** method.
Returns the `mixed`value.

### `getValue()`<a name="getValue"> </a>

Return the value of the switch

#### Signature

- **public** method.
Returns `string`value.

