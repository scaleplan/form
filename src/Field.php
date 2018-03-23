<?php

namespace avtomon;

use phpQuery;

class FieldException extends \Exception
{
}

class Field extends AbstractFormComponent
{
    /**
     * Настройки объекта по умолчанию
     *
     * @var array
     */
    protected static $settings = [
        'type' => 'text',
        'templatePath' => '/views/private/forms',
        'hintHTML' => '<i class="material-icons tooltipped" data-position="right" data-delay="50" data-tooltip="I am a tooltip">info_outline</i>',
        'hintAttribute' => 'data-tooltip'
    ];

    /**
     * Доступные виды полей ввода
     */
    const ALLOWED_TYPES = [
        'text',
        'select',
        'textarea',
        'radio',
        'password',
        'file',
        'template',
        'date',
        'datetime',
        'color',
        'datetime-local',
        'email',
        'number',
        'range',
        'search',
        'tel',
        'time',
        'url',
        'month',
        'week',
        'hidden'
    ];

    /**
     * Расширение файлов шаблонов полей
     */
    const TEMPLATE_EXTENSION = 'html';

    /**
     * Тип поля
     *
     * @var string
     */
    protected $type = 'text';

    /**
     * Имя поля
     *
     * @var string
     */
    protected $name = '';

    /**
     * Текст метки поля
     *
     * @var string
     */
    protected $labelText = '';

    /**
     * Значение поля
     *
     * @var string
     */
    protected $value = '';

    /**
     * Текст пустого элемента списка
     *
     * @var string
     */
    protected $emptyText = '';

    /**
     * Элементы выпадающего списка
     *
     * @var array
     */
    protected $options = [];

    /**
     * Путь к директории с шаблонами полей
     *
     * @var string
     */
    protected $templatePath = '/views/private/forms';

    /**
     * Имя файла шаблона поля
     *
     * @var string
     */
    protected $template = '';

    /**
     * Текст подсказки поля
     *
     * @var string
     */
    protected $hint = '';

    /**
     * HTML-разметка элемента подсказки
     *
     * @var string
     */
    protected $hintHTML = '';

    /**
     * В какой атрибудт вставлять текст подсказки
     *
     * @var string
     */
    protected $hintAttribute = '';

    /**
     * Варианты радио-баттона
     *
     * @var array
     */
    protected $variants = [];

    /**
     * Объект обертки поля ввода
     *
     * @var null|FieldWrapper
     */
    protected $fieldWrapper = null;

    /**
     * Конструктор
     *
     * @param array $settings - настройки объекта
     *
     * @throws FieldException
     */
    public function __construct(array $settings)
    {
        if (empty($settings['type'])) {
            throw new FieldException('Не задан тип поля');
        }

        if (empty($settings['name'])) {
            throw new FieldException('Не задано имя поля');
        }

        if (empty($settings['labelText'])) {
            throw new FieldException('Не задан текст метки поля');
        }

        if (!empty($settings['fieldWrapper'])) {
            $settings['fieldWrapper'] = new FieldWrapper($settings['fieldWrapper']);
        }

        if (!empty($settings['options']) && is_array($settings['options'])) {
            foreach ($settings['options'] as &$option) {
                $option = new Option($option);
            }
        }

        if (!empty($settings['variants']) && is_array($settings['variants'])) {
            foreach ($settings['variants'] as &$variant) {
                $variant = new RadioVariant($variant);
            }
        }

        parent::__construct($settings);
    }

    /**
     * Установить обертку поля
     *
     * @param FieldWrapper $fieldWrapper - объект обертки
     */
    public function setFieldWrapper(FieldWrapper $fieldWrapper)
    {
        $this->fieldWrapper = $fieldWrapper;
    }

    /**
     * Установить шаблон поля
     *
     * @param string $template
     */
    public function setTemplate(string $template)
    {
        if (!$template) {
            return;
        }

        if (!preg_match('/.+\.' . self::TEMPLATE_EXTENSION . '$/')) {
            $template = "$template." . self::TEMPLATE_EXTENSION;
        }

        $this->template = $template;
    }

    /**
     * Установить тип поля
     *
     * @param string $type - тип
     *
     * @throws FieldException
     */
    public function setType(string $type)
    {
        if (!in_array($type, self::ALLOWED_TYPES)) {
            throw new FieldException("Тип поля $type не поддерживается");
        }

        $this->type = $type;
    }

    /**
     * Установить элементы выпадающего списка
     *
     * @param array $options - список объектов элементов
     */
    public function setOptions(array $options)
    {
        foreach ($options as $option) {
            if (!($option instanceof Option)) {
                continue;
            }

            $this->options[] = $option;
        }
    }

    /**
     * Установить варианты выбора переключателя
     *
     * @param array $variants - список объектов вариантов
     */
    public function setVariants(array $variants)
    {
        foreach ($variants as $variant) {
            if (!($variant instanceof RadioVariant)) {
                continue;
            }

            $this->variants[] = $variant;
        }
    }

    /**
     * Установить значение поля
     *
     * @param $value - значение
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * Добавить элемент выпадающего списка
     *
     * @param Option $option - объект элемента списка
     */
    public function addOption(Option $option)
    {
        $this->options[] = $option;
    }

    /**
     * Вернуть имя поля
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Вренуть тип поля
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Отрендерить поле выпадающего списка
     *
     * @return false|null|\phpQueryObject|\QueryTemplatesParse|\QueryTemplatesPhpQuery|\QueryTemplatesSource|\QueryTemplatesSourceQuery|String
     *
     * @throws \Exception
     */
    protected function renderSelect()
    {
        if ($this->type !== 'select') {
            return null;
        }

        $field = phpQuery::pq('<select>')->val($this->value);
        FormHelper::renderAttributes($field, $this->attributes);

        array_unshift($this->options, new Option(['text' => $this->emptyText]));

        foreach($this->options as $option) {
            $option->render()->appendTo($field);
        }

        return $field;
    }

    /**
     * Отрендерить подсказку поля
     *
     * @return false|null|\phpQueryObject|\QueryTemplatesParse|\QueryTemplatesPhpQuery|\QueryTemplatesSource|\QueryTemplatesSourceQuery|String
     *
     * @throws \Exception
     */
    protected function renderFieldHint()
    {
        if (empty($this->hint)) {
            return null;
        }

        return phpQuery::pq($this->hintHTML)->attr($this->hintAttribute, $this->hint);
    }

    /**
     * Отрендерить поле представленное шаблоном
     *
     * @return false|null|\phpQueryObject|\QueryTemplatesParse|\QueryTemplatesPhpQuery|\QueryTemplatesSource|\QueryTemplatesSourceQuery
     *
     * @throws FieldException
     * @throws \Exception
     */
    protected function renderTemplate()
    {
        if ($this->type !== 'template') {
            return null;
        }

        if (empty($this->templatePath) || empty($this->template)) {
            throw new FieldException('Не задан путь к шаблонам полей или имя шаблона');
        }

        $fieldWrapper = phpQuery::pq(file_get_contents($this->templatePath . '/' . $this->template));
        $fieldWrapper->find('label, .label')->text($this->labelText);
        $field = $fieldWrapper->find('input, select, textarea')->val($this->value);
        $hint = $this->renderFieldHint();
        $field->after($hint);
        self::renderAttributes($field, $this->attributes);

        $fieldWrapper->find('*[data-view]')->attr('data-view', $field->name);

        return $fieldWrapper;
    }

    /**
     * Отрендерить однострочное поле ввода
     *
     * @return false|null|\phpQueryObject|\QueryTemplatesParse|\QueryTemplatesPhpQuery|\QueryTemplatesSource|\QueryTemplatesSourceQuery|String
     *
     * @throws \Exception
     */
    protected function renderInput()
    {
        if (in_array($this->type, ['radio', 'textarea', 'select', 'template', 'hidden'])) {
            return null;
        }

        $field = phpQuery::pq('<input>')->val($this->value);
        self::renderAttributes($field, $this->attributes);

        return $field;
    }

    /**
     * Отрендерить скрытое поле ввода
     *
     * @return false|null|\phpQueryObject|\QueryTemplatesParse|\QueryTemplatesPhpQuery|\QueryTemplatesSource|\QueryTemplatesSourceQuery|String
     *
     * @throws \Exception
     */
    protected function renderHidden()
    {
        if ($this->type === 'hidden') {
            return null;
        }

        if (!is_array($this->value)) {
            $this->value = [$this->value];
        }

        $field = phpQuery::pq('<input>');
        self::renderAttributes($field, $this->attributes);

        $field->val(array_shift($this->value));
        foreach ($this->value as $value) {
            $clone = $field->clone()->val($value);
            $field->after($field);
            $field = $clone;
        }

        return $field;
    }

    /**
     * Отрендерить переключатель
     *
     * @return false|null|\phpQueryObject|\QueryTemplatesParse|\QueryTemplatesPhpQuery|\QueryTemplatesSource|\QueryTemplatesSourceQuery|String
     */
    protected function renderRadio()
    {
        if ($this->type !== 'radio') {
            return null;
        }

        $radio = array_shift($this->variants)->render();
        foreach ($this->variants as $variant) {
            if ($variant->getValue() === $this->value) {
                $variant->addAttribute('checked', 'checked');
            }

            $radio->after($variant->render());
        }

        return $radio;
    }

    /**
     * Отрендерить многострочное поле ввода
     *
     * @return false|null|\phpQueryObject|\QueryTemplatesParse|\QueryTemplatesPhpQuery|\QueryTemplatesSource|\QueryTemplatesSourceQuery|String
     *
     * @throws \Exception
     */
    protected function renderTextarea()
    {
        if ($this->type !== 'textarea') {
            return null;
        }

        $field = phpQuery::pq('<textarea>')->val($this->value);
        self::renderAttributes($field, $this->attributes);

        return $field;
    }

    /**
     * Отрендерить поле
     *
     * @return false|null|\phpQueryObject|\QueryTemplatesParse|\QueryTemplatesPhpQuery|\QueryTemplatesSource|\QueryTemplatesSourceQuery|String
     *
     * @throws FieldException
     * @throws \Exception
     */
    public function render()
    {
        switch ($this->type) {
            case 'select':
                $field = $this->renderSelect();
                break;

            case 'textarea':
                $field = $this->renderTextarea();
                break;

            case 'radio':
                $field = $this->renderRadio();
                break;

            case 'template':
                $field = $this->renderTemplate();
                break;

            default:
                $field = $this->renderInput();
        }

        if ($this->fieldWrapper) {
            $fieldWrapper = $this->fieldWrapper->render();
            $fieldWrapper->append($field);
            return $fieldWrapper;
        }

        return $field;
    }
}