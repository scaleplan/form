<?php

namespace avtomon;

use phpQuery;

/**
 * Класс ошибки
 *
 * Class FormException
 * @package avtomon
 */
class FormException extends CustomException
{
}

/**
 * Класс формы
 *
 * Class Form
 * @package avtomon
 */
class Form
{
    /**
     * Трейт инициализации
     */
    use InitTrait;

    /**
     * В какой раздел добавлять дополнительно сгенерированные поля формы
     *
     * @const int
     */
    protected const ADDITIONAL_FIELDS_SECTION_NUMBER = 0;

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
     * Дополнительно сгенерированные поля формы
     *
     * @var array
     */
    protected $additionalFields = [];

    /**
     * Конструктор
     *
     * @param array $formConf - параметры конфигурации
     *
     * @throws FieldException
     * @throws VariantException
     * @throws \ReflectionException
     */
    public function __construct(array $formConf)
    {
        $this->formConf = &$formConf;

        if (!empty($formConf['sections']) && \is_array($formConf['sections'])) {
            foreach ($formConf['sections'] as &$section) {
                $section['buttons'] = array_merge($formConf['buttons'] ?? [], $section['buttons'] ?? []);
                $section = new Section($section);
            }

            unset($section);
        } else if (!empty($formConf['fields']) && \is_array($formConf['fields'])) {
            foreach ($formConf['fields'] as &$field) {
                $field = new Field($field);
            }

            unset($field);
        }

        $this->initObject($formConf);
    }

    /**
     * Установить настройки формы
     *
     * @param array $form - настройки формы
     */
    public function setForm(array $form): void
    {
        $form['method'] = 'POST';
        $this->form = $form;
    }

    /**
     * Установить разделы формы
     *
     * @param array $sections
     */
    public function setSections(array $sections): void
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
    public function addSection(Section $section): void
    {
        $this->sections[$section->getTitle()] = $section;
    }

    /**
     * Добавить поле к форме
     *
     * @param Field $field - добавляемое поле
     * @param int $sectionNumber - номер раздела формы, в который добавлять поле
     * @param bool $isAppend - добавлять поле в конец и в начала раздела
     *
     * @return Form
     *
     * @throws FormException
     */
    public function addField(Field $field, int $sectionNumber = -1, bool $isAppend = true): Form
    {
        if ($this->sections) {
            if ($sectionNumber === -1) {
                $sectionNumber = \count($this->sections) - 1;
            }

            if (empty(array_keys($this->sections)[$sectionNumber])) {
                throw new FormException('Задан неверный индекст раздела формы');
            }

            $section = $this->sections[array_keys($this->sections)[$sectionNumber]];
            $isAppend ? $section->appendField($field) : $section->prependField($field);
            return $this;
        }

        $isAppend ? array_push($this->fields, $field) : array_unshift($this->fields, $field);

        return $this;
    }

    /**
     * Добавить поле к форме в конец раздела
     *
     * @param Field $field - добавляемое поле
     * @param int $sectionNumber - номер раздела формы, в который добавлять поле
     *
     * @return Form
     *
     * @throws FormException
     */
    public function appendField(Field $field, int $sectionNumber = -1): Form
    {
        return $this->addField($field, $sectionNumber);
    }

    /**
     * Добавить поле к форме в начало раздела
     *
     * @param Field $field - добавляемое поле
     * @param int $sectionNumber - номер раздела формы, в который добавлять поле
     *
     * @return Form
     *
     * @throws FormException
     */
    public function prependField(Field $field, int $sectionNumber = -1): Form
    {
        return $this->addField($field, $sectionNumber, false);
    }

    /**
     * Установить поля формы
     *
     * @param array $fields
     */
    public function setFields(array $fields): void
    {
        foreach ($fields as $field) {
            if (!($field instanceof Field)) {
                continue;
            }

            $this->fields[] = $field;
        }
    }

    /**
     * Превратить форму в HTML-разметку
     *
     * @return \phpQueryObject|\QueryTemplatesParse|\QueryTemplatesSource|\QueryTemplatesSourceQuery|string
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
                if ($title === array_keys($this->sections)[self::ADDITIONAL_FIELDS_SECTION_NUMBER]) {
                    $section = clone $section;
                    $section->setFields(array_merge($this->additionalFields, $section->getFields()));
                }

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
     * @throws FieldException
     * @throws VariantException
     * @throws \ReflectionException
     */
    public function setFormValues(array $valuesObject): void
    {
        foreach ($this->sections as $section) {
            foreach ($section->getFields() as $field) {
                $name = rtrim($field->getName(), '[]');
                if (!array_key_exists($name, $valuesObject)) {
                    continue;
                }

                if ($this->setFileValue($field, $valuesObject[$name])) {
                    continue;
                }

                $field->setValue($valuesObject[$name]);
            }
        }
    }

    /**
     * Вставка изображений
     *
     * @param Field $field - поле-эталон
     * @param $value - изображение или массив изображений
     *
     * @return null|\phpQueryObject|\QueryTemplatesParse|\QueryTemplatesSource|\QueryTemplatesSourceQuery
     * @throws \Exception
     */
    protected function setImageValue(Field $field, string $value)
    {
        if (!$value || $field->getType() !== 'file') {
            return null;
        }

        if (!$field->getRenderedTemplate() || !((string) $element = $field->getRenderedTemplate()->find("img[data-view='{$field->getName()}']"))) {
            return null;
        }

        $element->attr('src', $value);

        return $element;
    }

    /**
     * Вставка изображений
     *
     * @param Field $field - поле-эталон
     * @param $value - изображение или массив изображений
     *
     * @return Field|null
     *
     * @throws FieldException
     * @throws VariantException
     * @throws \ReflectionException
     * @throws \Exception
     */
    protected function setFileValue(Field $field, $value): ?Field
    {
        if (!$value || $field->getType() !== 'file') {
            return null;
        }

        $name = $field->getName();

        if (!\is_array($value)) {
            if ($this->setImageValue($field, $value)) {
                return $field;
            }

            $value = [$value];
        }

        $newField = $field;
        if (!$field->getRenderedTemplate() || !((string) $dataView = $field->getRenderedTemplate()->find("*[data-view='{$field->getName()}']"))) {
            return null;
        }

        foreach ($value as $file) {
            if (empty($file[$this->filePathKey])) {
                continue;
            }

            $file[$this->filePosterKey] = $file[$this->filePosterKey] ?? '';

            $newField = new Field(
                [
                    'type' => 'hidden',
                    'name' => $this->fileNamePrefix . $name,
                    //'data-poster' => $file[$this->filePosterKey],
                    //'data-name' => $file[$this->fileNameKey],
                    'value' => $file[$this->filePathKey]
                ]
            );

            $this->additionalFields[] = $newField;

            if ($dataView) {
                $clone = $dataView->clone()
                    ->removeClass('no-image')
                    ->attr('src', $file[$this->filePosterKey])
                    ->attr('data-object-src', $file[$this->filePathKey])
                    ->attr('title', $file[$this->fileNameKey])
                    ->attr('data-type', $field->getAttribute('data-type') ?: '')
                    ->attr('data-source', $this->fileNamePrefix . $name);

                $dataView->after($clone);
                if ($dataView->hasClass('no-image')) {
                    $dataView->addClass('no-display');
                }

                $dataView = $clone;
            }
        }

        return $newField;
    }

    /**
     * Установить опции для выпадающего списка
     *
     * @param string $selectName - имя списка
     * @param array $options - элементы списка
     * @param null $emptyText - текст пустого пункта
     * @param null $selectedValue - элемент по умолчанию
     *
     * @return Field|null
     */
    public function setSelectOptions(string $selectName, array $options, $emptyText = null, $selectedValue = null): ?Field
    {
        $search = function (array $fields) use (&$selectName, &$options, &$emptyText, &$selectedValue): ?Field {
            $result = null;
            foreach ($fields as &$field) {
                if ($field->getName() !== $selectName) {
                    continue;
                }

                $result = $field;

                $field->setEmptyText($emptyText);
                $field->setSelectedValue($selectedValue);
                foreach ($options as $option) {
                    $option = new Option($option);
                    $field->addOption($option);
                }
            }

            return $result;
        };

        if ($this->sections) {
            $result = null;
            foreach ($this->sections as $section) {
                $result = $search($section->getFields());
            }

            return $result;
        }

        return $search($this->fields);
    }

    /**
     * Установить параметр action формы
     *
     * @param string $newAction - новое значение action
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
     *
     * @throws \Exception
     */
    public function __toString(): string
    {
        return (string) $this->render();
    }

    /**
     * Вернуть текст заголовка формы
     *
     * @return string
     */
    public function getTitleText(): string
    {
        return $this->title['text'] ?? '';
    }

    /**
     * Установка текста заголовка формы
     *
     * @param string $newText
     */
    public function setTitleText(string $newText): void
    {
        $this->title['text'] = $newText;
    }
}