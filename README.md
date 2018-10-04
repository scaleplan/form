# SkaForm

Form Builder for PHP.

#### Installation

`
composer reqire scaleplan/form
`

<br>

#### Description

To generate a form, you need:
- form template
- shape configuration

A form template is an HTML file with a new form inserted into its body, and in the simplest case it can look like this:

```
<html>
  the <head>
    <title>example form template</title>  
  </head>
  the <body>
  
  </body>
</html>
```

The size and complexity of the configuration depends on the complexity of the form. For example, privedem form redaktirovaniya user data:

```
labelAfter: 1
invisibleClass: no-display
currentClass: current
currentNumber: 0

templatePath:/views/private/forms/templates

title:
  text: Edit user profile

form:
  id: main
  action:/user/update
  novalidate: novalidate

menu:
  class: z-depth-3

sections:
  - title: Basic
    id: main_info
    fields:
      - fieldWrapper:
          class: input-field
        type: text
        name: login
        labelText: Login
        data-input: "'mask': 'x{3,}'"
        required: required

      - fieldWrapper:
          class: input-field
        type: email
        name: email
        labelText: E-mail
        data-input: "'alias': 'email'"
        required: required

      - fieldWrapper:
          class: input-field
        type: tel
        name: phone_number
        labelText: phone Number
        data-input: "'mask': '+7 (999) 999-99-99'"

    buttons:
      - text: Forward
        class: next

  - title: Career
    id: carrier
    fields:
      - fieldWrapper:
          class: input-field
        type: select
        name: education
        labelText: Education

      - fieldWrapper:
          class: input-field
        type: text
        name: job_place
        labelText: place of work

      - fieldWrapper:
          class: input-field
        type: text
        name: post
        labelText: Position

    buttons:
      - text: Back
        class: prev

      - text: Forward
        class: next

  - title: Avatar
    id: avatar
    fields:
      - type: file
        template: thumb_template.html
        name: image
        labelText: Upload your avatar
        class: 'image thumb'

    buttons:
      - text: Back
        class: prev

buttons:
  - class: reset
  - type: submit
```

Consider the configuration directives:
- <b > labelAfter </b > - generate labels after fields;

<b>invisibleClass</b> - which class to use for element hiding;

- <b>currentClass</b> - class denoting the selected menu item (indicates the selected section of the form);

- <b>currentNumber</b> - which section of the form to choose by default;

- <b > templatePath</b> - absolute path to the form template;

- <b>title</b> - description of the form title, <I> text</I > -title text, you can also add any HTML attributes such as id, class, and the like...

- <b > form</b> - attributes of the form itself (<I>\<form></i>tag);

- <b>menu </b > - form menu attributes (<I>\<menu > </I > tag), makes sense if the form has sections (<I>sections</i>));

- <b> sections</b > - form sections with attributes. In addition, the menu is formed by sections: menu items (<I>\<a></I> tag) have the same anchor as the <I>title</I> attribute of the section and, if the section has <I>id</I>, for example, <I>main_info</I>, the corresponding menu item will have <I>href="#main_info"</I>. This part can be omitted if the form is not necessary to divide razdely, then the <i>fields</i> will be in the root config;

- <b > fields</b> - form fields, attributes, templates and their wrappers, if necessary:
  - templates are used when instead of a blank form field, for example, input, we want to use an HTML template and already template elements to set attributes;
  - wrapper is the element into which the form element is wrapped, by default it is <i>\<div></i>, i.e. from
  ```
  - fieldWrapper:
      class: input-field
  ```
  the generated wrapper will be 
  ```
  <div class= "input-field" ></div>
  ```
 
- <b> buttons</b > - in the section context, these are buttons of the section with attributes, in the form context - common for all sections of the button.

That's easy. Despite the possible volumetric configuration of the form, it is very easy to fall on the HTML-model

<br>

#### Now generation:

```
$form = new Form(Yaml:: parse(file_get_contents('user.yml')));
echo $form->render();
```

That's all. The output will form.

<br>

[Class documentation](docs_en)
