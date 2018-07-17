# SkaForm

Form Builder in PHP.

To generate a form, you need:
- form template
- shape configuration

A form template is an HTML file with a new form inserted into its body, and in the simplest case it can look like this:

"'html
<html>
  the <head>
    <title>example form template</title>  
  </head>
  the <body>
  
  </body>
</html>
```

The size and complexity of the configuration depends on the complexity of the form. For example, privedem form redaktirovaniya user data:

"'yaml
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
- **labelAfter* * - generate labels after fields;

- **invisibleClass** - which class to use for element hiding;

- ***currentClass * * - class denoting the selected menu item (pointing to the selected section of the form);

- ***currentNumber* * - which section of the form to choose by default;

- ***templatePath* * - absolute path to the form template;

- **title ** - description of the form title,* text* - title text, you can also add any HTML-attributes, such as id, class, and the like...

- **form ** - attributes of the form (tag*\<form>)*);

- **menu ** - attributes of the form menu (tag* <menu>*), it makes sense if the form has sections (*sections*);

- **sections ** - form sections with attributes. In addition, the menu is formed by sections: menu items (tag *<a>*) have the same anchor as the *title* attribute of the section and, if the section has *id*, for example, *main_info*, the corresponding menu item will have *href="#main_info"*. This part can be omitted if the form is not necessary to divide razdely, then section*fields* will be in the root config;

- **fields * * - form fields, attributes, templates and their wrappers, if necessary:
  - templates are used when instead of a blank form field, for example, input, we want to use an HTML template and already template elements to set attributes;
   wrapper is an element, which wraps the form element, defaults to *\<div>*, i.e.,
  "'yaml
  - fieldWrapper:
      class: input-field
  ```
  the generated wrapper will be 
  "'html
  <div class= "input-field" ></div>
  ```
 
- ***buttons* * - in the context of this section, this section buttons with attributes, in the context of the form-common to all sections of the button.

That's easy. Despite the possible volumetric configuration of the form, it is very easy to fall on the HTML-model

<br>

#### Now generation:

"'php
$form = new Form(Yaml:: parse(file_get_contents('user.yml')));
echo $form->render();
```

That's all. The output will form.

<br>

[Class documentation](docs_en)
