<?php

namespace avtomon;

use phpQuery;

class SectionException extends CustomException
{
}

class Section extends AbstractFormComponent
{
    /**
     * Заголовок раздела формы
     *
     * @var string
     */
    protected $title = '';

    /**
     * Поля раздела
     *
     * @var array
     */
    protected $fields = [];

    /**
     * Кнопки раздела
     *
     * @var array
     */
    protected $buttons = [];

    /**
     * Идентификатор раздела
     *
     * @var string
     */
    protected $id = '';

    /**
     * Конструктор
     *
     * @param array $settings - настройки объекта
     *
     * @throws SectionException
     */
    public function __construct(array $settings)
    {
        /*if (empty($settings['title'])) {
            throw new SectionException('Не задан текст кнопки');
        }*/

        if (!empty($settings['fields']) && is_array($settings['fields'])) {
            foreach ($settings['fields'] as &$field) {
                $field = new Field($field);
            }
        }

        if (!empty($settings['buttons']) && is_array($settings['buttons'])) {
            foreach ($settings['buttons'] as &$button) {
                $button = new Button($button);
            }
        }

        parent::__construct($settings);
    }

    /**
     * Установить поля раздела
     *
     * @param array $fields - список полей
     */
    public function setFields(array $fields)
    {
        $this->fields = [];
        foreach ($fields as $field) {
            if (!($field instanceof Field)) {
                continue;
            }

            $this->fields[] = $field;
        }
    }

    /**
     * Добавить поле к разделу
     *
     * @param Field $field - объект поля
     */
    public function addField(Field $field)
    {
        $this->fields[] = $field;
    }

    /**
     * Удалить поле раздела по имени
     *
     * @param Field $field - удаляемое поле
     */
    public function deleteField(Field $field)
    {
        unset($this->fields[array_search($field, $this->fields)]);
    }

    /**
     * Установить кнопки раздела
     *
     * @param array $buttons - массив кнопок
     */
    public function setButtons(array $buttons)
    {
        foreach ($buttons as $button) {
            if (!($button instanceof Button)) {
                continue;
            }

            $this->buttons[] = $button;
        }
    }

    /**
     * Добавить кпопку к разделу
     *
     * @param Button $button - объект кнопки
     */
    public function addButton(Button $button)
    {
        $this->buttons[] = $button;
    }

    /**
     * Установить заголовок раздела
     *
     * @param string $title - новый заголовок
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    /**
     * Отрендерить раздел формы
     *
     * @return \phpQueryObject|\QueryTemplatesParse|\QueryTemplatesSource|\QueryTemplatesSourceQuery|null
     */
    public function render()
    {
        $formSection = phpQuery::pq('<section>')->attr('id', $this->id);
        FormHelper::renderAttributes($formSection, $this->attributes);

        foreach ($this->fields as $field) {
            $field->render()->appendTo($formSection);
        }

        foreach ($this->buttons as $button) {
            $button->render()->appendTo($formSection);
        }

        return $formSection;
    }

    /**
     * Вернуть поля раздела
     *
     * @return array
     */
    public function getFields(): array
    {
        return $this->fields;
    }

    /**
     * Вернуть заголовок раздела
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Вернуть идентификатор раздела
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }
}