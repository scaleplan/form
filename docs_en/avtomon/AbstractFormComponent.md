<small> avtomon </small>

AbstractFormComponent
=====================

Base class of form components

Description
-----------

Class AbstractFormComponent

Signature
---------

- **abstract class**.

Properties
----------

The abstract class sets the following properties:

  - [`$attributes`](#$attributes) &mdash; Form element attributes

### `$attributes`<a name="attributes"> </a>

Form element attributes

#### Signature

- **protected** property.
- The value of `array`.

Methods
-------

Abstract class methods:

  - [`__construct()`](#__construct) &mdash; Constructor
  - [`setAttributes()`](#setAttributes) &mdash; Set attribute values
  - [`addAttribute()`](#addAttribute) &mdash; Add attribute
  - [`render()`](#render) &mdash; Turn an object into HTML markup
  - [`__toString()`](#__toString) &mdash; Return an object as a string

### `__construct()`<a name="__construct"> </a>

Constructor

#### Signature

- **public** method.
- It can take the following parameter (s):
  - `$settings`(`array`) - object settings
- Returns nothing.
- Throws one of the following exceptions:
  - [`ReflectionException`](http://php.net/class.ReflectionException)

### `setAttributes()`<a name="setAttributes"> </a>

Set attribute values

#### Signature

- **public** method.
- It can take the following parameter (s):
  - `$attributes`(`array`) - array of attributes
- Returns nothing.

### `addAttribute()`<a name="addAttribute"> </a>

Add attribute

#### Signature

- **public** method.
- It can take the following parameter (s):
  - `$name`(`string`) - the name of the attribute
  - `$value`(`string`) - the value of the attribute
- Returns nothing.

### `render()`<a name="render"> </a>

Turn an object into HTML markup

#### Signature

- **public abstract** method.
Returns the `mixed`value.

### `__toString()`<a name="__toString"> </a>

Return an object as a string

#### Signature

- **public** method.
Returns `string`value.

