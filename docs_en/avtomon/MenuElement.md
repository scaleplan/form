<small> avtomon </small>

MenuElement
===========

Class of menu items

Description
-----------

Class MenuElement

Signature
---------

- **class**.
- It is a subclass of the class [`AbstractFormComponent`](../avtomon/AbstractFormComponent.md).

Properties
----------

class sets the following properties:

  - [`$settings`](#$settings) &mdash; Default object settings
  - [`$text`](#$text) &mdash; Menu item text
  - [`$tag`](#$tag) &mdash; Menu item tag
  - [`$hash`](#$hash) &mdash; Hash links, if the menu item is a link

### `$settings`<a name="settings"> </a>

Default object settings

#### Signature

**protected static** property.
- The value of `array`.

### `$text`<a name="text"> </a>

Menu item text

#### Signature

- **protected** property.
- The value of `string`.

### `$tag`<a name="tag"> </a>

Menu item tag

#### Signature

- **protected** property.
- The value of `string`.

### `$hash`<a name="hash"> </a>

Hash links, if the menu item is a link

#### Signature

- **protected** property.
- The value of `string`.

Methods
-------

Class methods class:

  - [`__construct()`](#__construct) &mdash; Constructor
  - [`setHash()`](#setHash) &mdash; Set the hash of the menu item
  - [`setText()`](#setText) &mdash; Set the text of the menu item
  - [`render()`](#render) &mdash; To render the menu item

### `__construct()`<a name="__construct"> </a>

Constructor

#### Signature

- **public** method.
- It can take the following parameter (s):
  - `$settings`(`array`) - object settings
- Returns nothing.
- Throws one of the following exceptions:
  - [`avtomon\MenuElementException`](../avtomon/MenuElementException.md)
  - [`ReflectionException`](http://php.net/class.ReflectionException)

### `setHash()`<a name="setHash"> </a>

Set the hash of the menu item

#### Signature

- **public** method.
- It can take the following parameter (s):
  - `$hash`(`string`) - hash
- Returns nothing.
- Throws one of the following exceptions:
  - [`avtomon\MenuElementException`](../avtomon/MenuElementException.md)

### `setText()`<a name="setText"> </a>

Set the text of the menu item

#### Signature

- **public** method.
- It can take the following parameter (s):
  - `$text`(`string`) - text
- Returns nothing.

### `render()`<a name="render"> </a>

To render the menu item

#### Signature

- **public** method.
Returns the `mixed`value.
- Throws one of the following exceptions:
  - [`Exception`](http://php.net/class.Exception)

