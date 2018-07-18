# SkaForm

Конструктор форм на PHP.

#### Установка

``
composer reqire avtomon/skaform
``

<br>

#### Описание

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
- <b>labelAfter</b> - генерируем метки после полей;

- <b>invisibleClass</b> - какой класс используем для сокрытия элементов;

- <b>currentClass</b> - класс, обозначающий выбранный пункт меню (указывает на выбранный раздел формы);

- <b>currentNumber</b> - какой раздел формы выбрать по умолчанию;

- <b>templatePath</b> - абсолютный путь к шаблону формы;

- <b>title</b> - описание заголовка формы, <i>text</i> - текст заголовка, так же можно добавлять какие угодно HTML-атрибуты, такие как id, class и тому подобное...

- <b>form</b> - атрибуты самой формы (тега <i>\<form></i>);

- <b>menu</b> - атрибуты меню формы (тега <i>\<menu></i>), имеет смысл если форма имеет разделы (<i>sections</i>);

- <b>sections</b> - разделы формы с аттрибутами. Кроме того, по разделам формируется меню: элементы меню (тег <i>\<a></i>) имеют тот же анкор что и атрибут <i>title</i> раздела и, если у раздела есть <i>id</i>, например, <i>main_info</i>, то соответствующий элемент меню будет иметь <i>href="#main_info"</i>. Эта часть может отсутствовать если форму не нужно делить на резделы, тогда раздел <i>fields</i> будет находиться в корне конфига;

- <b>fields</b> - поля формы, атрибуты, шаблоны и их обертки, если нужно:
  - шаблоны используются когда вместо чистого поля формы, наример, input мы хотим использовать HTML-шаблон и уже элементам шаблона задавать атрибуты;
  - обертка это элемент, в который оборачивается элемент формы, по умолчанию это <i>\<div></i>, т. е. из
  ```
  - fieldWrapper:
      class: input-field
  ``` 
  будет сгенерированная обертка 
  ```
  <div class="input-field"></div>
  ```
 
- <b>buttons</b> - в контексте раздела это кнопки раздела с атрибутами, в контексте формы - общие для всех разделов кнопки.

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
