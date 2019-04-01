<?php

namespace Scaleplan\Form\Interfaces;

use Scaleplan\Form\Exceptions;
use Scaleplan\Form\Exceptions\FormException;
use Scaleplan\Form\Fields\AbstractField;
use Scaleplan\Form\Form;
use Scaleplan\Form\Section;

/**
 * Класс формы
 *
 * Class Form
 * @package Scaleplan\Form
 */
interface FormInterface
{
    /**
     * FormInterface constructor.
     *
     * @param array $formConf
     */
    public function __construct(array $formConf);

    /**
     * Установить настройки формы
     *
     * @param array $form - настройки формы
     */
    public function setForm(array $form) : void;

    /**
     * Установить разделы формы
     *
     * @param array $sections
     */
    public function setSections(array $sections) : void;

    /**
     * Добавить раздел формы
     *
     * @param Section $section
     */
    public function addSection(Section $section) : void;

    /**
     * Добавить поле к форме
     *
     * @param AbstractField $field - добавляемое поле
     * @param int $sectionNumber - номер раздела формы, в который добавлять поле
     * @param bool $isAppend - добавлять поле в конец и в начала раздела
     *
     * @return Form
     *
     * @throws FormException
     */
    public function addField(AbstractField $field, int $sectionNumber = -1, bool $isAppend = true) : Form;

    /**
     * Добавить поле к форме в конец раздела
     *
     * @param AbstractField $field - добавляемое поле
     * @param int $sectionNumber - номер раздела формы, в который добавлять поле
     *
     * @return Form
     *
     * @throws FormException
     */
    public function appendField(AbstractField $field, int $sectionNumber = -1) : Form;

    /**
     * Добавить поле к форме в начало раздела
     *
     * @param AbstractField $field - добавляемое поле
     * @param int $sectionNumber - номер раздела формы, в который добавлять поле
     *
     * @return Form
     *
     * @throws FormException
     */
    public function prependField(AbstractField $field, int $sectionNumber = -1) : Form;

    /**
     * Установить поля формы
     *
     * @param array $fields
     */
    public function setFields(array $fields) : void;

    /**
     * Превратить форму в HTML-разметку
     *
     * @return \phpQueryObject
     *
     * @throws \Exception
     */
    public function render() : \phpQueryObject;

    /**
     * Заполняить поля форма значениями
     *
     * @param array $valuesObject - массив значений в формате <имя поля> => <значение>
     *
     * @throws Exceptions\FieldException
     * @throws Exceptions\RadioVariantException
     */
    public function setFormValues(array $valuesObject) : void;

    /**
     * Установить опции для выпадающего списка
     *
     * @param string $selectName - имя списка
     * @param array $options - элементы списка
     * @param string $emptyText - текст пустого пункта
     * @param mixed $selectedValue - элемент по умолчанию
     */
    public function setSelectOptions(string $selectName, array $options, string $emptyText = null, $selectedValue = null) : void;

    /**
     * Установить параметр action формы
     *
     * @param string $newAction - новое значение action
     */
    public function setFormAction(string $newAction) : void;

    /**
     * Вернуть конфиг формы
     *
     * @return array
     */
    public function getFormConf() : array;

    /**
     * Вернуть текст заголовка формы
     *
     * @return string
     */
    public function getTitleText() : string;

    /**
     * Установка текста заголовка формы
     *
     * @param string $newText
     */
    public function setTitleText(string $newText) : void;
}
