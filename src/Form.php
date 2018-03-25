<?php

namespace avtomon;

use phpQuery;

class FormException extends CustomException
{
}

class Form
{
    use InitTrait;

    /**
     * Конфигурация формы
     *
     * @var array
     */
    protected $formConf = [];

    /**
     * Настройки заголовка формы
     *
     * @var array
     */
    protected $title = [];

    /**
     * Настройки меню
     *
     * @var array
     */
    protected $menu = [];

    /**
     * Настроки формы
     *
     * @var array
     */
    protected $form = [];

    /**
     * Имя поля содержащего значение <option>
     *
     * @var string
     */
    protected $selectValueFieldName = 'value';

    /**
     * Имя поля содержащего тектс <option>
     *
     * @var string
     */
    protected $selectTextFieldName = 'text';

    /**
     * Класс картинки отображающей отсутствие картинок
     *
     * @var string
     */
    protected $stopImageClass = 'no-image';

    /**
     * Индекс пути к файлу в массиве файлов,
     *
     * @var string
     */
    protected $filePathKey = 'file_path';

    /**
     * Индекс пути к постеру файла (если есть) в массиве файлов
     *
     * @var string
     */
    protected $filePosterKey = 'file_poster';

    /**
     * Индеск изначального имени файла в массиве файлов
     *
     * @var string
     */
    protected $fileNameKey = 'file_name';

    /**
     * Префикс для подгжужаемых в форму, ранее сохраненных файлов
     *
     * @var string
     */
    protected $fileNamePrefix = 'old_';

    /**
     * Разделы полей формы
     *
     * @var array
     */
    protected $sections = [];

    /**
     * Поля формы (вне разделов)
     *
     * @var array
     */
    protected $fields = [];

    /**
     * Конструктор
     *
     * @param array $formConf - параметры конфигурации
     *
     * @throws FormException
     */
    public function __construct(array $formConf)
    {
        $this->formConf = &$formConf;

        if (!empty($formConf['sections']) && is_array($formConf['sections'])) {
            foreach ($settings['sections'] as &$section) {
                $section = new Section($section);
            }
        } else if (!empty($formConf['fields']) && is_array($formConf['fields'])) {
            foreach ($formConf['fields'] as &$field) {
                $field = new Field($field);
            }
        }

        $this->initObject($formConf);
    }

    /**
     * Установить настройки формы
     *
     * @param array $form - настройки формы
     */
    public function setForm(array $form)
    {
        $form['method'] = 'POST';
        $this->form = $form;
    }

    /**
     * Установить разделы формы
     *
     * @param array $sections
     */
    public function setSections(array $sections)
    {
        foreach ($sections as $section) {
            if (!($section instanceof Section)) {
                continue;
            }

            $this->sections[$section->getTitle()] = $section;
        }
    }

    /**
     * Добавить раздел формы
     *
     * @param Section $section
     */
    public function addSection(Section $section)
    {
        $this->sections[$section->getTitle()] = $section;
    }

    /**
     * Установить поля формы
     *
     * @param array $fields
     */
    public function setFields(array $fields)
    {
        foreach ($fields as $field) {
            if (!($field instanceof Field)) {
                continue;
            }

            $this->fields[$field->getName()] = $field;
        }
    }

    /**
     * Превратить форму в HTML-разметку
     *
     * @return \phpQueryObject|\QueryTemplatesParse|\QueryTemplatesSource|\QueryTemplatesSourceQuery
     *
     * @throws \Exception
     */
    public function render()
    {
        $formDocument = phpQuery::newDocument();

        $formParent = phpQuery::pq('<div>')->attr('id', 'formParent')->appendTo($formDocument);

        $title = phpQuery::pq('<div>')->html($this->title['text'] ?? '')->appendTo($formParent);
        FormHelper::renderAttributes($title, $this->title);

        $form = phpQuery::pq('<form>')->appendTo($formParent);
        FormHelper::renderAttributes($form, $this->form);

        if ($this->sections) {
            $menu = phpQuery::pq('<menu>');
            FormHelper::renderAttributes($menu, $this->menu);
            $title->after($menu);

            foreach($this->sections as $title => $section) {
                $form->append($section->render());
                $menu->append((new MenuElement(['text' => $title, 'hash' => $section->getId() ? '#' . $section->getId() : '']))->render());
            }
        } else {
            foreach($this->fields as $name => $field) {
                $form->append($field->render());
            }
        }

        if (isset($menu) && !empty($this->formConf['invisibleClass']) && !empty($this->formConf['currentClass'])) {
            $visibleNumber = !empty($this->formConf['currentNumber']) ? $this->formConf['currentNumber'] : 0;
            $form->find('section')->eq($visibleNumber)->siblings('section')->addClass($this->formConf['invisibleClass']);
            $menu->find('a')->eq($visibleNumber)->addClass($this->formConf['currentClass']);
        }

        return $formDocument;
    }

    /**
     * Заполняить поля форма значениями
     *
     * @param array $valuesObject - массив значений в формате <имя поля> => <значение>
     *
     * @return $this
     */
    public function setFormValues(array $valuesObject)
    {
        foreach ($this->sections as $section) {
            foreach ($section->getFields() as $name => $field) {
                if (!array_key_exists($name, $valuesObject)) {
                    continue;
                }

                if ($field->getType() === 'file') {
                    $this->setFileValue($name, $valuesObject[$name]);
                    continue;
                }

                $field->setValue($valuesObject[$name]);
            }
        }

        return $this;
    }

    /**
     * Вставка изображений
     *
     * @param string $name - имя элемента для отображения картинки
     * @param $value - изображение или массив изображений
     *
     * @return \phpQueryObject|\QueryTemplatesParse|\QueryTemplatesSource|\QueryTemplatesSourceQuery
     */
    protected function setImageValue(string $name, string $value)
    {
        if (!((string) $element = $this->form->find("img[data-view='$name']"))) {
            return;
        }

        $element->attr('src', $value);

        return $element;
    }

    /**
     * Вставка изображений
     *
     * @param string $name - имя элемента для отображения картинки
     * @param $value - изображение или массив изображений
     *
     * @return \phpQueryObject|\QueryTemplatesParse|\QueryTemplatesSource|\QueryTemplatesSourceQuery
     */
    protected function setFileValue(string $name, $value)
    {
        if (!is_array($value)) {
            $value = [$value];
        } else {
            $name = "{$name}[]";
        }

        foreach ($value as $file) {
            if (empty($file[$this->filePathKey])) {
                continue;
            }

            $file[$this->filePosterKey] = $file[$this->filePosterKey] ?? '';

            $field = [
                'type' => 'hidden',
                'name' => $this->fileNamePrefix . $name,
                'data-poster' => $file[$this->filePosterKey],
                'data-name' => $file[$this->fileNameKey],
                'value' => $file[$this->filePathKey]
            ];

            $this->sections[0]->addField(new Field($field));
        }

        return $field;
    }



    /**
     * Установить опции для выпадающего списка
     *
     * @param string $selectName - имя списка
     * @param array $options - элементы списка
     */
    public function setSelectOptions(string $selectName, array $options, $emptyText = '', $selectedValue = '')
    {
        $search = function (array &$fields) use (&$selectName, &$options, &$emptyText, &$selectedValue) {
            foreach ($fields as $name => $field) {
                if ($name !== $selectName) {
                    continue;
                }

                $field->setEmptyText($emptyText);
                $field->setSelectedValue($selectedValue);
                foreach ($options as $option) {
                    $option = new Option($option);
                    $field->addOption($option);
                }
            }
        };

        foreach ($this->sections as $section) {
            $search($section->getFields());
        }

        $search($this->fields);
    }

    /**
     * Установить параметр action формы
     *
     * @param string $newAction - новое значение action
     *
     * @return \phpQueryObject|\QueryTemplatesParse|\QueryTemplatesSource|\QueryTemplatesSourceQuery|null
     */
    public function setFormAction(string $newAction): void
    {
        $this->form['action'] = $newAction;
    }

    /**
     * Вернуть конфиг формы
     *
     * @return array
     */
    public function getFormConf(): array
    {
        return $this->formConf;
    }

    /**
     * Вернуть объект в виде строки
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->render();
    }

    public function getTitleText(): string
    {
        return $this->title['text'] ?? '';
    }
}