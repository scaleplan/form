<small> avtomon </small>

Field
=====

Form Field Class

Description
-----------

Class Field

Signature
---------

- **class**.
- It is a subclass of the class [`AbstractFormComponent`](../avtomon/AbstractFormComponent.md).

Constants
---------

class sets the following constants:

  - [`ALLOWED_TYPES`](#ALLOWED_TYPES) ​​&mdash; Available types of input fields
  - [`TEMPLATE_EXTENSION`](#TEMPLATE_EXTENSION) &mdash; Extension of Field Template Files

Properties
----------

class sets the following properties:

  - [`$settings`](#$settings) &mdash; Default object settings
  - [`$type`](#$type) &mdash; Field Type
  - [`$name`](#$name) &mdash; Field name
  - [`$labelText`](#$labelText) &mdash; Field Label Text
  - [`$value`](#$value) &mdash; Field Value
  - [`$emptyText`](#$emptyText) &mdash; Empty list item text
  - [`$options`](#$options) &mdash; Items in the drop-down list
  - [`$templatePath`](#$templatePath) &mdash; The path to the directory with the template fields
  - [`$template`](#$template) &mdash; Field template file name
  - [`$hint`](#$hint) &mdash; Field prompt text
  - [`$hintHTML`](#$hintHTML) &mdash; HTML tagging of the hint element
  - [`$hintSelector`](#$hintSelector) &mdash; Selector, by which you can find the hint element in the template
  - [`$hintAttribute`](#$hintAttribute) &mdash; In which attribute to insert the prompt text
  - [`$variants`](#$variants) &mdash; Radio Button Options
  - [`$fieldWrapper`](#$fieldWrapper) &mdash; Wrapper object of input field
  - [`$selectedValue`](#$selectedValue) &mdash; The value of the selected list item by default
  - [`$renderedTemplate`](#$renderedTemplate) &mdash; phpQuery-Field Template Object

### `$settings`<a name="settings"> </a>

Default object settings

#### Signature

**protected static** property.
- The value of `array`.

### `$type`<a name="type"> </a>

Field Type

#### Signature

- **protected** property.
- The value of `string`.

### `$name`<a name="name"> </a>

Field name

#### Signature

- **protected** property.
- The value of `string`.

### `$labelText`<a name="labelText"> </a>

Field Label Text

#### Signature

- **protected** property.
- The value of `string`.

### `$value`<a name="value"> </a>

Field Value

#### Signature

- **protected** property.
- The value of `string`.

### `$emptyText`<a name="emptyText"> </a>

Empty list item text

#### Signature

- **protected** property.
- The value of `string`.

### `$options`<a name="options"> </a>

Items in the drop-down list

#### Signature

- **protected** property.
- The value of `array`.

### `$templatePath`<a name="templatePath"> </a>

The path to the directory with the template fields

#### Signature

- **protected** property.
- The value of `string`.

### `$template`<a name="template"> </a>

Field template file name

#### Signature

- **protected** property.
- The value of `string`.

### `$hint`<a name="hint"> </a>

Field prompt text

#### Signature

- **protected** property.
- The value of `string`.

### `$hintHTML`<a name="hintHTML"> </a>

HTML tagging of the hint element

#### Signature

- **protected** property.
- The value of `string`.

### `$hintSelector`<a name="hintSelector"> </a>

Selector, by which you can find the hint element in the template

#### Signature

- **protected** property.
- The value of `string`.

### `$hintAttribute`<a name="hintAttribute"> </a>

In which attribute to insert the prompt text

#### Signature

- **protected** property.
- The value of `string`.

### `$variants`<a name="variants"> </a>

Radio Button Options

#### Signature

- **protected** property.
- The value of `array`.

### `$fieldWrapper`<a name="fieldWrapper"> </a>

Wrapper object of input field

#### Signature

- **protected** property.
- Can be one of the following types:
  - `null`
  - [`FieldWrapper`](../avtomon/FieldWrapper.md)

### `$selectedValue`<a name="selectedValue"> </a>

The value of the selected list item by default

#### Signature

- **protected** property.
- The value of `string`.

### `$renderedTemplate`<a name="renderedTemplate"> </a>

phpQuery-Field Template Object

#### Signature

- **protected** property.
- Can be one of the following types:
  - `null`
  - `phpQueryObject`
  - `QueryTemplatesParse`
  - `QueryTemplatesPhpQuery`
  - `QueryTemplatesSource`
  - `QueryTemplatesSourceQuery`

Methods
-------

Class methods class:

  - [`__construct()`](#__construct) &mdash; Constructor
  - [`setFieldWrapper()`](#setFieldWrapper) &mdash; Set Field Wrapper
  - [`setTemplate()`](#setTemplate) &mdash; Set Field Template
  - [`setType()`](#setType) &mdash; Set Field Type
  - [`setOptions()`](#setOptions) &mdash; Set items in the drop-down list
  - [`setVariants()`](#setVariants) &mdash; Set options for selecting a switch
  - [`addVariant()`](#addVariant) &mdash; Add option to select the switch
  - [`setValue()`](#setValue) &mdash; Set Field Value
  - [`setText()`](#setText) &mdash; Set the name of the field
  - [`setLabelText()`](#setLabelText) &mdash; Set Field Label Text
  - [`setEmptyText()`](#setEmptyText) &mdash; Set the text of an empty list item
  - [`setTemplatePath()`](#setTemplatePath) &mdash; Set the path to the directory with the template fields
  - [`setSelectedValue()`](#setSelectedValue) &mdash; Set the default list item value
  - [`addOption()`](#addOption) &mdash; Add dropdown list item
  - [`getName()`](#getName) &mdash; Return field name
  - [`getType()`](#getType) &mdash; Define Field Type
  - [`getAttribute()`](#getAttribute) &mdash; Return the value of the attribute, if any
  - [`renderSelect()`](#renderSelect) &mdash; To render the dropdown list box
  - [`renderFieldHint()`](#renderFieldHint) &mdash; To render a prompt for the field
  - [`renderLabel()`](#renderLabel) &mdash; Rendering field labels
  - [`getRenderedTemplate()`](#getRenderedTemplate) &mdash; To render the field represented by a template
  - [`renderInput()`](#renderInput) &mdash; To render a one-line input field
  - [`renderHidden()`](#renderHidden) &mdash; To render the hidden input field
  - [`renderSwitch()`](#renderSwitch) &mdash; To render the switch
  - [`renderTextarea()`](#renderTextarea) &mdash; Multi-line input field
  - [`render()`](#render) &mdash; To render the field

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

### `setFieldWrapper()`<a name="setFieldWrapper"> </a>

Set Field Wrapper

#### Signature

- **public** method.
- It can take the following parameter (s):
  - `$fieldWrapper`([`FieldWrapper`](../avtomon/FieldWrapper.md)) - the wrapper object
- Returns nothing.

### `setTemplate()`<a name="setTemplate"> </a>

Set Field Template

#### Signature

- **public** method.
- It can take the following parameter (s):
  - `$template`(`string`)
- Returns nothing.

### `setType()`<a name="setType"> </a>

Set Field Type

#### Signature

- **public** method.
- It can take the following parameter (s):
  - `$type`(`string`) - type
- Returns nothing.
- Throws one of the following exceptions:
  - [`avtomon\FieldException`](../avtomon/FieldException.md)

### `setOptions()`<a name="setOptions"> </a>

Set items in the drop-down list

#### Signature

- **public** method.
- It can take the following parameter (s):
  - `$options`(`array`) - list of item objects
- Returns nothing.

### `setVariants()`<a name="setVariants"> </a>

Set options for selecting a switch

#### Signature

- **public** method.
- It can take the following parameter (s):
  - `$variants`(`array`) - list of options objects
- Returns nothing.

### `addVariant()`<a name="addVariant"> </a>

Add option to select the switch

#### Signature

- **public** method.
- It can take the following parameter (s):
  - `$variant`([`Variant`](../avtomon/Variant.md)) - the option to be added
- Returns nothing.

### `setValue()`<a name="setValue"> </a>

Set Field Value

#### Signature

- **public** method.
- It can take the following parameter (s):
  - `$value`- value
- Returns nothing.

### `setText()`<a name="setText"> </a>

Set the name of the field

#### Signature

- **public** method.
- It can take the following parameter (s):
  - `$name`- name
- Returns nothing.

### `setLabelText()`<a name="setLabelText"> </a>

Set Field Label Text

#### Signature

- **public** method.
- It can take the following parameter (s):
  - `$labelText`- text
- Returns nothing.

### `setEmptyText()`<a name="setEmptyText"> </a>

Set the text of an empty list item

#### Signature

- **public** method.
- It can take the following parameter (s):
  - `$emptyText`- text
- Returns nothing.

### `setTemplatePath()`<a name="setTemplatePath"> </a>

Set the path to the directory with the template fields

#### Signature

- **public** method.
- It can take the following parameter (s):
  - `$templatePath`(`string`) - path
- Returns nothing.

### `setSelectedValue()`<a name="setSelectedValue"> </a>

Set the default list item value

#### Signature

- **public** method.
- It can take the following parameter (s):
  - `$selectedValue`- value
- Returns nothing.

### `addOption()`<a name="addOption"> </a>

Add dropdown list item

#### Signature

- **public** method.
- It can take the following parameter (s):
  - `$option`([`Option`](../avtomon/Option.md)) - item object of the list
- Returns nothing.

### `getName()`<a name="getName"> </a>

Return field name

#### Signature

- **public** method.
Returns `string`value.

### `getType()`<a name="getType"> </a>

Define Field Type

#### Signature

- **public** method.
Returns `string`value.

### `getAttribute()`<a name="getAttribute"> </a>

Return the value of the attribute, if any

#### Signature

- **public** method.
- It can take the following parameter (s):
  - `$name`(`string`) - the name of the required attribute
Returns the `mixed`value.

### `renderSelect()`<a name="renderSelect"> </a>

To render the dropdown list box

#### Signature

- **protected** method.
- Can return one of the following values:
  - `avtomon\false`
  - `null`
  - `phpQueryObject`
  - `QueryTemplatesParse`
  - `QueryTemplatesPhpQuery`
  - `QueryTemplatesSource`
  - `QueryTemplatesSourceQuery`
  - `String`
- Throws one of the following exceptions:
  - [`Exception`](http://php.net/class.Exception)

### `renderFieldHint()`<a name="renderFieldHint"> </a>

To render a prompt for the field

#### Signature

- **protected** method.
- Can return one of the following values:
  - `avtomon\false`
  - `null`
  - `phpQueryObject`
  - `QueryTemplatesParse`
  - `QueryTemplatesPhpQuery`
  - `QueryTemplatesSource`
  - `QueryTemplatesSourceQuery`
  - `String`
- Throws one of the following exceptions:
  - [`Exception`](http://php.net/class.Exception)

### `renderLabel()`<a name="renderLabel"> </a>

Rendering field labels

#### Signature

- **protected** method.
- Can return one of the following values:
  - `null`
  - `phpQueryObject`
  - `QueryTemplatesParse`
  - `QueryTemplatesPhpQuery`
  - `QueryTemplatesSource`
  - `QueryTemplatesSourceQuery`
- Throws one of the following exceptions:
  - [`Exception`](http://php.net/class.Exception)

### `getRenderedTemplate()`<a name="getRenderedTemplate"> </a>

To render the field represented by a template

#### Signature

- **public** method.
- Can return one of the following values:
  - `avtomon\false`
  - `null`
  - `phpQueryObject`
  - `QueryTemplatesParse`
  - `QueryTemplatesPhpQuery`
  - `QueryTemplatesSource`
  - `QueryTemplatesSourceQuery`
- Throws one of the following exceptions:
  - [`Exception`](http://php.net/class.Exception)

### `renderInput()`<a name="renderInput"> </a>

To render a one-line input field

#### Signature

- **protected** method.
- Can return one of the following values:
  - `avtomon\false`
  - `null`
  - `phpQueryObject`
  - `QueryTemplatesParse`
  - `QueryTemplatesPhpQuery`
  - `QueryTemplatesSource`
  - `QueryTemplatesSourceQuery`
  - `String`
- Throws one of the following exceptions:
  - [`Exception`](http://php.net/class.Exception)

### `renderHidden()`<a name="renderHidden"> </a>

To render the hidden input field

#### Signature

- **protected** method.
- Can return one of the following values:
  - `avtomon\false`
  - `null`
  - `phpQueryObject`
  - `QueryTemplatesParse`
  - `QueryTemplatesPhpQuery`
  - `QueryTemplatesSource`
  - `QueryTemplatesSourceQuery`
  - `String`
- Throws one of the following exceptions:
  - [`Exception`](http://php.net/class.Exception)

### `renderSwitch()`<a name="renderSwitch"> </a>

To render the switch

#### Signature

- **protected** method.
- Can return one of the following values:
  - `null`
  - `phpQueryObject`
  - `QueryTemplatesParse`
  - `QueryTemplatesPhpQuery`
  - `QueryTemplatesSource`
  - `QueryTemplatesSourceQuery`
  - `string`
- Throws one of the following exceptions:
  - [`Exception`](http://php.net/class.Exception)

### `renderTextarea()`<a name="renderTextarea"> </a>

Multi-line input field

#### Signature

- **protected** method.
- Can return one of the following values:
  - `avtomon\false`
  - `null`
  - `phpQueryObject`
  - `QueryTemplatesParse`
  - `QueryTemplatesPhpQuery`
  - `QueryTemplatesSource`
  - `QueryTemplatesSourceQuery`
  - `String`
- Throws one of the following exceptions:
  - [`Exception`](http://php.net/class.Exception)

### `render()`<a name="render"> </a>

To render the field

#### Signature

- **public** method.
Returns the `mixed`value.
- Throws one of the following exceptions:
  - [`Exception`](http://php.net/class.Exception)

