<?php
declare(strict_types=1);

namespace Scaleplan\Form;

use PhpQuery\PhpQuery;
use PhpQuery\PhpQueryObject;
use Scaleplan\Form\Exceptions\FormException;
use Scaleplan\Form\Fields\AbstractField;
use Scaleplan\Form\Fields\FieldFabric;
use Scaleplan\Form\Fields\HiddenField;
use Scaleplan\Form\Fields\Option;
use Scaleplan\Form\Fields\SelectField;
use Scaleplan\Form\Interfaces\FormInterface;
use Scaleplan\Form\Interfaces\RenderInterface;
use Scaleplan\InitTrait\InitTrait;
use Scaleplan\Templater\Templater;
use function Scaleplan\Translator\translate;

/**
 * Класс формы
 *
 * Class Form
 * @package Scaleplan\Form
 */
class Form implements RenderInterface, FormInterface
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
     * @var string
     */
    protected $onlyForAttribute = 'only-for';

    /**
     * @var string
     */
    protected $privacyKey = 'privacy';

    /**
     * Разделы полей формы
     *
     * @var Section[]
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
     * @var string|null
     */
    protected $privacy;

    /**
     * Form constructor.
     *
     * @param array $formConf - параметры конфигурации
     * @param string $type - тип формы
     *
     * @throws Exceptions\FieldException
     * @throws Exceptions\RadioVariantException
     * @throws FormException
     * @throws \ReflectionException
     * @throws \Scaleplan\DependencyInjection\Exceptions\ContainerTypeNotSupportingException
     * @throws \Scaleplan\DependencyInjection\Exceptions\DependencyInjectionException
     * @throws \Scaleplan\DependencyInjection\Exceptions\ParameterMustBeInterfaceNameOrClassNameException
     * @throws \Scaleplan\DependencyInjection\Exceptions\ReturnTypeMustImplementsInterfaceException
     */
    public function __construct(array $formConf, string $type = 'put')
    {
        $this->formConf = &$formConf;
        $this->initObject($formConf);
        if (empty($formConf['sections']) || !\is_array($formConf['sections'])) {
            throw new FormException(translate('form.sections-not-set'));
        }

        $this->setFormType($type);
        if (!empty($this->form['action'][$type])) {
            $this->setFormAction($this->form['action'][$type]);
        }

        if (!empty($this->title['text'][$type])) {
            $this->setTitleText($this->title['text'][$type]);
        }

        $this->privacy = null;
        if (!empty($formConf[$this->privacyKey]['text'])
            && (empty($formConf[$this->privacyKey][$this->onlyForAttribute])
                || $formConf[$this->privacyKey][$this->onlyForAttribute] === $type)
        ) {
            $this->privacy = $formConf[$this->privacyKey]['text'];
        }

        $newSections = $formConf['sections'];
        foreach ($formConf['sections'] as $sectionIndex => &$section) {
            if (!empty($section[$this->onlyForAttribute])) {
                if ($section[$this->onlyForAttribute] !== $type) {
                    unset($newSections[$sectionIndex]);
                    continue;
                }

                unset($newSections[$sectionIndex][$this->onlyForAttribute]);
            }

            foreach ($section['fields'] as $fieldIndex => &$field) {
                if (!empty($field[$this->onlyForAttribute])) {
                    if ($field[$this->onlyForAttribute] !== $type) {
                        unset($newSections[$sectionIndex]['fields'][$fieldIndex]);
                        continue;
                    }

                    unset($newSections[$sectionIndex]['fields'][$fieldIndex][$this->onlyForAttribute]);
                }
            }
            unset($field);
        }
        unset($section);

        $this->sections = [];
        foreach ($newSections as &$section) {
            $section['buttons'] = array_merge($formConf['buttons'] ?? [], $section['buttons'] ?? []);
            $this->addSection(new Section($section));
        }
        unset($section);

        if (isset($formConf['labelAfter'])) {
            AbstractField::setSetting('labelAfter', $formConf['labelAfter']);
        }
    }

    /**
     * Установить настройки формы
     *
     * @param array $form - настройки формы
     */
    public function setForm(array $form) : void
    {
        $form['method'] = 'POST';
        $this->form = $form;
    }

    /**
     * Установить разделы формы
     *
     * @param array $sections
     */
    public function setSections(array $sections) : void
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
    public function addSection(Section $section) : void
    {
        $this->sections[$section->getTitle()] = $section;
    }

    /**
     * Удалить раздел по имени
     *
     * @param string $sectionName - удаляемая секция
     */
    public function deleteSection(string $sectionName) : void
    {
        unset($this->sections[$sectionName]);
    }

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
     * @throws \ReflectionException
     * @throws \Scaleplan\DependencyInjection\Exceptions\ContainerTypeNotSupportingException
     * @throws \Scaleplan\DependencyInjection\Exceptions\DependencyInjectionException
     * @throws \Scaleplan\DependencyInjection\Exceptions\ParameterMustBeInterfaceNameOrClassNameException
     * @throws \Scaleplan\DependencyInjection\Exceptions\ReturnTypeMustImplementsInterfaceException
     */
    public function addField(AbstractField $field, int $sectionNumber = -1, bool $isAppend = true) : Form
    {
        if ($this->sections) {
            if ($sectionNumber === -1) {
                $sectionNumber = \count($this->sections) - 1;
            }

            if (empty(array_keys($this->sections)[$sectionNumber])) {
                throw new FormException(translate('form.wrong-section-index'));
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
     * @param AbstractField $field - добавляемое поле
     * @param int $sectionNumber - номер раздела формы, в который добавлять поле
     *
     * @return Form
     *
     * @throws FormException
     */
    public function appendField(AbstractField $field, int $sectionNumber = -1) : Form
    {
        return $this->addField($field, $sectionNumber);
    }

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
    public function prependField(AbstractField $field, int $sectionNumber = -1) : Form
    {
        return $this->addField($field, $sectionNumber, false);
    }

    /**
     * Установить поля формы
     *
     * @param array $fields
     */
    public function setFields(array $fields) : void
    {
        foreach ($fields as $field) {
            if (!($field instanceof AbstractField)) {
                continue;
            }

            $this->fields[] = $field;
        }
    }

    /**
     * Превратить форму в HTML-разметку
     *
     * @return PhpQueryObject
     *
     * @throws \Exception
     */
    public function render() : PhpQueryObject
    {
        $formDocument = PhpQuery::newDocument();
        $formParent = PhpQuery::pq('<div>')->attr('id', 'formParent');
        $formParent && $formParent->appendTo($formDocument);

        /** @var PhpQueryObject $title */
        $title = PhpQuery::pq('<div>')->html($this->title['text'] ?? '');
        $title->appendTo($formParent);
        FormHelper::renderAttributes($title, $this->title);

        $form = PhpQuery::pq('<form>')->appendTo($formParent);
        FormHelper::renderAttributes($form, $this->form);

        if ($this->sections) {
            $menu = PhpQuery::pq('<menu>');
            FormHelper::renderAttributes($menu, $this->menu);
            $title->after($menu);

            foreach ($this->sections as $title => $section) {
                if ($title === array_keys($this->sections)[static::ADDITIONAL_FIELDS_SECTION_NUMBER]) {
                    $section = clone $section;
                    $section->setFields(array_merge($this->additionalFields, $section->getFields()));
                }

                $form->append($section->render());
                $menu->append((new MenuElement(['text' => $title, 'hash' => $section->getId() ? '#' . $section->getId() : '']))->render());
            }
        } else {
            foreach ($this->fields as $field) {
                $form->append($field->render());
            }
        }

        if (isset($menu) && !empty($this->formConf['invisibleClass']) && !empty($this->formConf['currentClass'])) {
            $visibleNumber = !empty($this->formConf['currentNumber']) ? $this->formConf['currentNumber'] : 0;
            $form->find('section')->eq($visibleNumber)->siblings('section')->addClass($this->formConf['invisibleClass']);
            $menu->find('a')->eq($visibleNumber)->addClass($this->formConf['currentClass']);
        }


        $dataViews = [];
        /** @var HiddenField $field */
        foreach ($this->additionalFields as $field) {
            if (empty($dataViews[$field->getName()])) {
                $name = \str_replace($this->fileNamePrefix, '', $field->getName());
                $dataViews[$field->getName()] = $form->find("*[data-view='$name']");
            }

            /** @var PhpQueryObject $dataView */
            $dataView = $dataViews[$field->getName()];
            if ($dataView->count()) {
                if (\strpos($field->getName(), '[]') !== false) {
                    $clone = $dataView->clone();
                } else {
                    $clone = $dataView;
                }

                $clone->removeClass('no-image');
                $clone->removeClass('no-display');

                $data = [
                    'src'        => $field->getAttribute('data-poster') ?: $field->getValue(),
                    'object-src' => $field->getValue(),
                    'title'      => $field->getAttribute('data-name'),
                    'name'       => $field->getName(),
                    'type'       => $field->getAttribute('data-type'),
                    'value'      => $field->getValue(),
                ];

                (new Templater)->setData($data, $clone);

                $dataView->after($clone);
                $dataViews[$field->getName()] = $clone;
            }
        }

        if ($this->privacy) {
            $form->append(PhpQuery::pq('<div class="privacy">')->html($this->privacy));
        }

        return $formDocument;
    }

    /**
     * Заполняить поля форма значениями
     *
     * @param array $valuesObject - массив значений в формате <имя поля> => <значение>
     *
     * @throws Exceptions\FieldException
     * @throws Exceptions\RadioVariantException
     */
    public function setFormValues(array $valuesObject) : void
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
     * @param string $name
     * @param $value
     * @param bool $disabled
     */
    public function setFieldValue(string $name, $value, $disabled = false) : void
    {
        foreach ($this->sections as &$section) {
            foreach ($section->getFields() as &$field) {
                if ($field->getName() === $name) {
                    $field->setValue($value);
                    if ($disabled) {
                        $field->addAttribute('disabled', 'disabled');
                    }
                    return;
                }
            }
        }
    }

    /**
     * Вставка изображений
     *
     * @param AbstractField $field - поле-эталон
     * @param $value - изображение или массив изображений
     *
     * @return null|AbstractField
     *
     * @throws Exceptions\FieldException
     * @throws Exceptions\RadioVariantException
     * @throws \Exception
     */
    protected function setFileValue(AbstractField $field, $value) : ?AbstractField
    {
        if (!$value || !\in_array($field->getType(), [AbstractField::TEMPLATE, AbstractField::FILE,], true)) {
            return null;
        }

        $name = $field->getName();

        if (!\is_array($value)) {
            //$field->setValue($value);

            $value = [$value];
        }

        $newField = $field;
        foreach ($value as $file) {
            if (empty($file[$this->filePathKey])) {
                if (!\is_string($file)) {
                    continue;
                }

                $file = [$this->filePathKey => $file];
            }

            $file[$this->filePosterKey] = $file[$this->filePosterKey] ?? '';
            $file[$this->fileNameKey] = $file[$this->fileNameKey] ?? '';

            $nameArray = explode('.', $file[$this->filePathKey]);
            $ext = strtolower(end($nameArray));
            $newField = FieldFabric::getField(
                [
                    'type'        => 'hidden',
                    'name'        => $this->fileNamePrefix . $name,
                    'data-poster' => $file[$this->filePosterKey],
                    'data-name'   => $file[$this->fileNameKey],
                    'value'       => $file[$this->filePathKey],
                    'data-type'   => $ext,
                ]
            );

            $this->additionalFields[] = $newField;
        }

        return $newField;
    }

    /**
     * Установить опции для выпадающего списка
     *
     * @param string $selectName - имя списка
     * @param array $options - элементы списка
     * @param string $emptyText - текст пустого пункта
     * @param array $selectedValue - элемент по умолчанию
     * @param string $optGroupClass - в какую группу добавлять
     */
    public function setSelectOptions(
        string $selectName,
        array $options,
        ?string $emptyText = '',
        array $selectedValue = [],
        string $optGroupClass = null
    ) : void
    {
        $search = static function (array $fields)
        use (&$selectName, &$options, &$emptyText, &$selectedValue, &$optGroupClass) {

            $result = null;
            /** @var SelectField $field */
            foreach ($fields as &$field) {
                if ($field->getName() !== $selectName) {
                    continue;
                }

                $optionList = $field->getOptionList();
                if ($optGroupClass) {
                    if (!$field->getOptGroups()) {
                        return;
                    }

                    foreach ($field->getOptGroups() as $fieldGroup) {
                        if (!$fieldGroup->hasClass($optGroupClass)) {
                            continue;
                        }

                        $optionList = $fieldGroup->getOptionList();
                        break;
                    }
                }

                $field->setEmptyText($emptyText);
                $field->setValue($selectedValue);
                foreach ($options as $option) {
                    $option = new Option($option);
                    $optionList->addOption($option);
                }
            }
        };

        if ($this->sections) {
            $result = null;
            foreach ($this->sections as $section) {
                $fields = $section->getFields();
                $search($fields);
                $section->setFields($fields);
            }
        }

        $search($this->fields);
    }

    /**
     * @param string $selectName
     * @param array $selectedValue
     */
    public function setSelectedValue(string $selectName, array $selectedValue = []) : void
    {
        $search = static function (array $fields) use (&$selectName, &$selectedValue) {

            $result = null;
            /** @var SelectField $field */
            foreach ($fields as &$field) {
                if ($field->getName() !== $selectName) {
                    continue;
                }

                $field->setValue($selectedValue);
            }
        };

        if ($this->sections) {
            $result = null;
            foreach ($this->sections as $section) {
                $fields = $section->getFields();
                $search($fields);
                $section->setFields($fields);
            }
        }

        $search($this->fields);
    }

    /**
     * Установить параметр action формы
     *
     * @param string $newAction - новое значение action
     */
    public function setFormAction(string $newAction) : void
    {
        $this->form['action'] = $newAction;
    }

    /**
     * @param string $type
     */
    public function setFormType(string $type) : void
    {
        $this->form['type'] = $type;
    }

    /**
     * Вернуть конфиг формы
     *
     * @return array
     */
    public function getFormConf() : array
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
    public function __toString() : string
    {
        return (string)$this->render();
    }

    /**
     * Вернуть текст заголовка формы
     *
     * @return string
     */
    public function getTitleText() : string
    {
        return $this->title['text'] ?? '';
    }

    /**
     * Установка текста заголовка формы
     *
     * @param string $newText
     */
    public function setTitleText(string $newText) : void
    {
        $this->title['text'] = $newText;
    }

    /**
     * Добавить поле с идентификатором редактируемого объекта системы
     *
     * @param string $id - значение идентификатора объекта
     * @param int $sectionNumber - номер раздела формы, в который добавлять поле
     *
     * @return Form
     *
     * @throws Exceptions\FieldException
     * @throws Exceptions\RadioVariantException
     * @throws FormException
     */
    public function addIdField($id = '', int $sectionNumber = -1) : Form
    {
        $field = FieldFabric::getField(['type' => 'hidden', 'name' => 'id', 'value' => $id,]);
        return $this->addField($field, $sectionNumber);
    }
}
