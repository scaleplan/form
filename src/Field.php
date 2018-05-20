<?php

namespace avtomon;

use phpQuery;

class FieldException extends CustomException
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
        'templatePath' => '/views/private/forms/templates',
        'hintHTML' => '<i class="material-icons tooltipped" data-position="right" data-delay="50" data-tooltip="I am a tooltip">info_outline</i>',
        'hintSelector' => '.material-icons.tooltipped',
        'hintAttribute' => 'data-tooltip',
        'labelAfter' => true
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
    protected $templatePath = '/views/private/forms/templates';

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
     * Селектор, по которому можно будет найти элемент подсказки в шаблоне
     *
     * @var string
     */
    protected $hintSelector = '';

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
     * Значение выбранного элемента списка по умолчанию
     *
     * @var string
     */
    protected $selectedValue = '';

    /**
     * phpQuery-объект шаблона поля
     *
     * @var null|\phpQueryObject|\QueryTemplatesParse|\QueryTemplatesPhpQuery|\QueryTemplatesSource|\QueryTemplatesSourceQuery
     */
    protected $renderedTemplate = null;

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
            $settings['type'] = 'input';
        }

        if (empty($settings['name'])) {
            throw new FieldException('Не задано имя поля');
        }

        if (!empty($settings['fieldWrapper'])) {
            $settings['fieldWrapper'] = new FieldWrapper($settings['fieldWrapper'] + ['required' => $field['required'] ?? '']);
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

        if (empty($settings['id'])) {
            $settings['id'] = $settings['name'];
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

        if (!preg_match('/.+\.' . self::TEMPLATE_EXTENSION . '$/', $template)) {
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
        $this->value = (string) $value;
    }

    /**
     * Установить имя поля
     *
     * @param $name - имя
     */
    public function setText($name)
    {
        $this->name = (string) $name;
    }

    /**
     * Установить текст метки поля
     *
     * @param $labelText - текст
     */
    public function setLabelText($labelText)
    {
        $this->labelText = (string) $labelText;
    }

    /**
     * Установить текст пустого элемента списка
     *
     * @param $emptyText - текст
     */
    public function setEmptyText($emptyText)
    {
        $this->emptyText = $emptyText;
    }

    /**
     * Установить путь до директории с шаблонами полей
     *
     * @param string $templatePath - путь
     */
    public function setTemplatePath(string $templatePath)
    {
        $this->templatePath = $templatePath;
    }

    /**
     * Установить значение элемента списка, выбираемого по умолчанию
     *
     * @param $selectedValue - значение
     */
    public function setSelectedValue($selectedValue)
    {
        $this->selectedValue = $selectedValue;
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
     * Вернуть значение атрибута, если такой есть
     *
     * @param string $name - имя искомого атрибута
     *
     * @return mixed
     */
    public function getAttribute(string $name)
    {
        return $this->attributes[$name] ?? null;
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
        if ($this->getType() !== 'select') {
            return null;
        }

        if (!($field = $this->getRenderedTemplate() ? $this->getRenderedTemplate()->find('select') : phpQuery::pq('<select>'))) {
            return null;
        }

        $field->val($this->value)->attr('name', $this->getName());
        FormHelper::renderAttributes($field, $this->attributes);

        if (!is_null($this->emptyText)) {
            array_unshift($this->options, new Option(['text' => $this->emptyText]));
        }

        foreach($this->options as $option) {
            if (!is_null($this->selectedValue) && ($this->selectedValue === $option->getValue() || $this->selectedValue === $option->getText())) {
                $option->addAttribute('selected', 'selected');
            }

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

        if (!($hint = $this->getRenderedTemplate() ? $this->getRenderedTemplate()->find($this->hintSelector) : phpQuery::pq($this->hintHTML))) {
            return null;
        }

        return $hint->attr($this->hintAttribute, $this->hint);
    }

    /**
     * Рендеринг метки поля
     *
     * @return false|null|\phpQueryObject|\QueryTemplatesParse|\QueryTemplatesPhpQuery|\QueryTemplatesSource|\QueryTemplatesSourceQuery
     *
     * @throws \Exception
     */
    protected function renderLabel($label = null)
    {
        if (empty($this->labelText)) {
            return null;
        }

        if (!($label = $this->getRenderedTemplate() ? $this->getRenderedTemplate()->find('label') : phpQuery::pq('<label>'))) {
            return null;
        }

        return $label
            ->text($this->labelText)
            ->attr('for', $this->attributes['id']);
    }

    /**
     * Отрендерить поле представленное шаблоном
     *
     * @return false|null|\phpQueryObject|\QueryTemplatesParse|\QueryTemplatesPhpQuery|\QueryTemplatesSource|\QueryTemplatesSourceQuery
     *
     * @throws FieldException
     * @throws \Exception
     */
    public function getRenderedTemplate()
    {
        if (!is_null($this->renderedTemplate)) {
            return $this->renderedTemplate;
        }

        if (empty($this->templatePath) || empty($this->template)) {
            return $this->renderedTemplate = false;
        }

        $this->renderedTemplate = phpQuery::newDocumentFileHTML($_SERVER['DOCUMENT_ROOT'] . $this->templatePath . '/' . $this->template);
        $this->renderedTemplate->find('*[data-view]')->attr('data-view', $this->name);

        return $this->renderedTemplate;
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
        if (in_array($this->getType(), ['radio', 'textarea', 'select', 'hidden'])) {
            return null;
        }

        if (!($field = $this->getRenderedTemplate() ? $this->getRenderedTemplate()->find("input[type='{$this->getType()}']") : phpQuery::pq('<input>')->attr('type', $this->getType()))) {
            return null;
        }

        $field
            ->val($this->value)
            ->attr('name', $this->getName());

        FormHelper::renderAttributes($field, $this->attributes);

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
        if ($this->getType() !== 'hidden') {
            return null;
        }

        if (!($field = $this->getRenderedTemplate() ? $this->getRenderedTemplate()->find("input[type='hidden']") : phpQuery::pq('<input>')->attr('type', 'hidden'))) {
            return null;
        }

        if (!is_array($this->value)) {
            $this->value = [$this->value];
        }

        $field->attr('name', $this->getName());

        FormHelper::renderAttributes($field, $this->attributes);

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

        if (!($field = $this->getRenderedTemplate() ? $this->getRenderedTemplate()->find("input[type='radio']") : array_shift($this->variants)->render())) {
            return null;
        }

        foreach ($this->variants as $variant) {
            if ($variant->getValue() === $this->value) {
                $variant->addAttribute('checked', 'checked');
            }

            $field->after($variant->render());
        }

        return $field;
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

        if (!($field = $this->getRenderedTemplate() ? $this->getRenderedTemplate()->find("textarea") : phpQuery::pq('<textarea>'))) {
            return null;
        }

        $field->val($this->value)->attr('name', $this->getName());
        FormHelper::renderAttributes($field, $this->attributes);

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

            case 'hidden':
                return $this->renderHidden();

            default:
                $field = $this->renderInput();
        }

        $label = $this->renderLabel();
        $hint = $this->renderFieldHint();

        if ($this->getRenderedTemplate()) {
            return $this->getRenderedTemplate();
        }

        if (!empty(self::$settings['labelAfter']))
            $elements = [&$field, &$hint, &$label];
        else {
            $elements = [&$label, &$field, &$hint];
        }

        if (!$this->fieldWrapper) {
            $object = phpQuery::pq('<div>');
            foreach ($elements as $el) {
                $object->append($el);
            }

            return $object;
        }

        $fieldWrapper = $this->fieldWrapper->render();

        foreach ($elements as $el) {
            $fieldWrapper->append($el);
        }

        return $fieldWrapper;
    }
}