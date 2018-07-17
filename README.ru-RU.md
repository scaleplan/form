# SkaForm

Конструктор форм на PHP.

Для генерации формы необходимы:
- шаблон формы
- конфигурация формы

Шаблон формы представляет собой HTML-файл, в тело которого вставляется новая форма, в простейшем случае он может выглядеть так:

```
<html>
  <head>
    <title>example form template</title>  
  </head>
  <body>
  
  </body>
</html>
```

Размер и сложность конфигурации зависит он сложности формы. Для примера, приведим форму радактирования данных пользователя:

```
labelAfter: 1
invisibleClass: no-display
currentClass: current
currentNumber: 0

templatePath: /views/private/forms/templates

title:
  text: Редактирование профиля пользователя

form:
  id: main
  action: /user/update
  novalidate: novalidate

menu:
  class: z-depth-3

sections:
  - title: Основное
    id: main_info
    fields:
      - fieldWrapper:
          class: input-field
        type: text
        name: login
        labelText: Логин
        data-inputmask: "'mask': 'x{3,}'"
        required: required

      - fieldWrapper:
          class: input-field
        type: email
        name: email
        labelText: E-mail
        data-inputmask: "'alias': 'email'"
        required: required

      - fieldWrapper:
          class: input-field
        type: tel
        name: phone_number
        labelText: Номер телефона
        data-inputmask: "'mask': '+7 (999) 999-99-99'"

    buttons:
      - text: Вперед
        class: next

  - title: Карьера
    id: carrier
    fields:
      - fieldWrapper:
          class: input-field
        type: select
        name: education
        labelText: Образование

      - fieldWrapper:
          class: input-field
        type: text
        name: job_place
        labelText: Место работы

      - fieldWrapper:
          class: input-field
        type: text
        name: post
        labelText: Должность

    buttons:
      - text: Назад
        class: prev

      - text: Вперед
        class: next

  - title: Аватар
    id: avatar
    fields:
      - type: file
        template: thumb_template.html
        name: image
        labelText: Загрузить аватар
        class: 'image thumb'

    buttons:
      - text: Назад
        class: prev

buttons:
  - class: reset
  - type: submit
```

Рассмотрим директивы конфигурации:
- **labelAfter** - генерируем метки после полей;

- **invisibleClass** - какой класс используем для сокрытия элементов;

- **currentClass** - класс, обозначающий выбранный пункт меню (указывает на выбранный раздел формы);

- **currentNumber** - какой раздел формы выбрать по умолчанию;

- **templatePath** - абсолютный путь к шаблону формы;

- **title** - описание заголовка формы, *text* - текст заголовка, так же можно добавлять какие угодно HTML-атрибуты, такие как id, class и тому подобное...

- **form** - атрибуты самой формы (тега *\<form>*);

- **menu** - атрибуты меню формы (тега *\<menu>*), имеет смысл если форма имеет разделы (*sections*);

- **sections** - разделы формы с аттрибутами. Кроме того, по разделам формируется меню: элементы меню (тег *\<a>*) имеют тот же анкор что и атрибут *title* раздела и, если у раздела есть *id*, например, *main_info*, то соответствующий элемент меню будет иметь *href="#main_info"*. Эта часть может отсутствовать если форму не нужно делить на резделы, тогда раздел *fields* будет находиться в корне конфига;

- **fields** - поля формы, атрибуты, шаблоны и их обертки, если нужно:
  - шаблоны используются когда вместо чистого поля формы, наример, input мы хотим использовать HTML-шаблон и уже элементам шаблона задавать атрибуты;
  - обертка это элемент, в который оборачивается элемент формы, по умолчанию это *\<div>*, т. е. из
  ```
  - fieldWrapper:
      class: input-field
  ``` 
  будет сгенерированная обертка 
  ```
  <div class="input-field"></div>
  ```
 
- **buttons** - в контексте раздела это кнопки раздела с атрибутами, в контексте формы - общие для всех разделов кнопки.

Вот так все просто. Не смотря на возможную объемность конфигурации формы, она очень легко ложится на HTML-модель

<br>

#### Теперь генерация:

```
$form = new Form(Yaml::parse(file_get_contents('user.yml')));
echo $form->render();
```

И всё. На выходе будет форма.

<br>

[Документация классов](docs_ru)
