<?php

namespace Scaleplan\Form;

use PhpQuery\PhpQuery;
use PhpQuery\PhpQueryObject;
use Scaleplan\Form\Fields\AbstractField;
use Scaleplan\Form\Fields\FieldFabric;

/**
 * Класс разделов формы
 *
 * Class Section
 * @package Scaleplan\Form
 */
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
     * @throws Exceptions\FieldException
     * @throws Exceptions\RadioVariantException
     */
    public function __construct(array $settings)
    {
        /*if (empty($settings['title'])) {
            throw new SectionException('Не задан заголовок раздела.');
        }*/

        if (!empty($settings['fields']) && \is_array($settings['fields'])) {
            foreach ($settings['fields'] as &$field) {
                $field = FieldFabric::getField($field);
            }

            unset($field);
        }

        if (!empty($settings['buttons']) && \is_array($settings['buttons'])) {
            foreach ($settings['buttons'] as &$button) {
                $button = new Button($button);
            }

            unset($button);
        }

        parent::__construct($settings);
    }

    /**
     * Установить поля раздела
     *
     * @param array $fields - список полей
     */
    public function setFields(array $fields) : void
    {
        $this->fields = [];
        foreach ($fields as $field) {
            if (!($field instanceof AbstractField)) {
                continue;
            }

            $this->fields[] = $field;
        }
    }

    /**
     * Добавить поле к разделу
     *
     * @param AbstractField $field - объект поля
     * @param bool $isAppend - добавлять поле в конец и в начала раздела
     */
    public function addField(AbstractField $field, bool $isAppend = true) : void
    {
        $isAppend ? array_push($this->fields, $field) : array_unshift($this->fields, $field);
    }

    /**
     * Добавить поле в конец раздела
     *
     * @param AbstractField $field - объект поля
     */
    public function appendField(AbstractField $field) : void
    {
        $this->addField($field);
    }

    /**
     * Добавить поле в начало раздела
     *
     * @param AbstractField $field - объект поля
     */
    public function prependField(AbstractField $field) : void
    {
        $this->addField($field, false);
    }

    /**
     * Удалить поле раздела
     *
     * @param AbstractField $field - удаляемое поле
     */
    public function deleteField(AbstractField $field) : void
    {
        unset($this->fields[array_search($field, $this->fields, true)]);
    }

    /**
     * Установить кнопки раздела
     *
     * @param array $buttons - массив кнопок
     */
    public function setButtons(array $buttons) : void
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
    public function addButton(Button $button) : void
    {
        $this->buttons[] = $button;
    }

    /**
     * Установить заголовок раздела
     *
     * @param string $title - новый заголовок
     */
    public function setTitle(string $title) : void
    {
        $this->title = $title;
    }

    /**
     * Отрендерить раздел формы
     *
     * @return PhpQueryObject|null
     *
     * @throws \Exception
     */
    public function render() : ?PhpQueryObject
    {
        $formSection = PhpQuery::pq('<section>')->attr('id', $this->id);
        FormHelper::renderAttributes($formSection, $this->attributes);

        /** @var AbstractField $field */
        foreach ($this->fields as $field) {
            $fieldRender = $field->render();
            $fieldRender && $fieldRender->appendTo($formSection);
        }

        /** @var Button $button */
        foreach ($this->buttons as $button) {
            $buttonRender = $button->render();
            $buttonRender && $buttonRender->appendTo($formSection);
        }

        return $formSection;
    }

    /**
     * Вернуть поля раздела
     *
     * @return AbstractField[]
     */
    public function getFields() : array
    {
        return $this->fields;
    }

    /**
     * Вернуть заголовок раздела
     *
     * @return string
     */
    public function getTitle() : string
    {
        return $this->title;
    }

    /**
     * Вернуть идентификатор раздела
     *
     * @return string
     */
    public function getId() : string
    {
        return $this->id;
    }
}
