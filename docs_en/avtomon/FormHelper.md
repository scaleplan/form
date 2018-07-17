<small> avtomon </small>

FormHelper
==========

A class of useful form methods

Description
-----------

Class FormHelper

Signature
---------

- **class**.

Methods
-------

Class methods class:

  - [`renderAttributes()`](#renderAttributes) &mdash; Add Attributes to an Item

### `renderAttributes()`<a name="renderAttributes"> </a>

Add Attributes to an Item

#### Signature

- **public static** method.
- It can take the following parameter (s):
  - `$el`(`phpQueryObject`| `QueryTemplatesParse`|`QueryTemplatesSource`| `QueryTemplatesSourceQuery`) - element
  - `$attrs`(`array`) - an attribute array of the form & lt; attribute name & gt; = & gt; & lt; Attribute value & gt;
  - `$stopAttrs`(`array`) - an array of attribute names that you do not need to add
- Can return one of the following values:
  - `phpQueryObject`
  - `QueryTemplatesParse`
  - `QueryTemplatesSource`
  - `QueryTemplatesSourceQuery`
  - `null`

