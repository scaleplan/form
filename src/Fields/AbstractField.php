<?php

namespace Scaleplan\Form\Fields;

use Scaleplan\Form\AbstractFormComponent;
use Scaleplan\Form\Exceptions\FieldException;

/**
 * Родительский класс полей формы
 *
 * Class AbstractField
 *
 * @package Scaleplan\Form;
 */
abstract class AbstractField extends AbstractFormComponent
{
    /**
     * Настройки объекта по умолчанию
     *
     * @var array
     */
    protected static $settings = [
        'hintHTML'      => '<i class="material-icons tooltipped" data-position="right" data-delay="50" data-tooltip="I am a tooltip">info_outline</i>',
        'hintSelector'  => '.material-icons.tooltipped',
        'hintAttribute' => 'data-tooltip',
        'labelAfter'    => true,
    ];

    /**
     * Доступные виды полей ввода
     */
    protected const ALLOWED_TYPES = [
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
        'hidden',
        'template',
    ];

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
     * Объект обертки поля ввода
     *
     * @var null|FieldWrapper
     */
    protected $fieldWrapper;

    /**
     * Конструктор
     *
     * @param array $settings - настройки объекта
     *
     * @throws FieldException
     */
    public function __construct(array $settings)
    {
        $this->setType($settings['type']);

        if (empty($settings['name'])) {
            throw new FieldException('Не задано имя поля');
        }

        if (!empty($settings['fieldWrapper'])) {
            $settings['fieldWrapper'] = new FieldWrapper($settings['fieldWrapper']);
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
    public function setFieldWrapper(FieldWrapper $fieldWrapper) : void
    {
        $this->fieldWrapper = $fieldWrapper;
    }

    /**
     * Установить тип поля
     *
     * @param string $type - тип
     *
     * @throws FieldException
     */
    public function setType(string $type) : void
    {
        if (!\in_array($type, static::ALLOWED_TYPES, true)) {
            throw new FieldException("Тип поля $type не поддерживается");
        }

        $this->type = $type;
    }

    /**
     * Установить значение поля
     *
     * @param $value - значение
     */
    public function setValue($value) : void
    {
        $this->value = (string)$value;
    }

    /**
     * Установить имя поля
     *
     * @param $name - имя
     */
    public function setName($name) : void
    {
        $this->name = (string)$name;
    }

    /**
     * Установить текст метки поля
     *
     * @param $labelText - текст
     */
    public function setLabelText($labelText) : void
    {
        $this->labelText = (string)$labelText;
    }

    /**
     * Вернуть имя поля
     *
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * Вренуть тип поля
     *
     * @return string
     */
    public function getType() : string
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
     * Отрендерить подсказку поля
     *
     * @return null|\phpQueryObject
     *
     * @throws \Exception
     */
    protected function renderFieldHint() : ?\phpQueryObject
    {
        if (empty($this->hint)) {
            return null;
        }

        $hint = \phpQuery::pq($this->hintHTML);

        return $hint->attr($this->hintAttribute, $this->hint);
    }

    /**
     * Рендеринг метки поля
     *
     * @return null|\phpQueryObject
     *
     * @throws \Exception
     */
    protected function renderLabel() : ?\phpQueryObject
    {
        if (empty($this->labelText)) {
            return null;
        }

        $label = \phpQuery::pq('<label>');
        $label->text($this->labelText);
        $label->attr('for', $this->attributes['id']);

        return $label;
    }

    /**
     * @param \phpQueryObject $field
     *
     * @return null|\phpQueryObject
     *
     * @throws \Exception
     */
    protected function renderEnding(\phpQueryObject $field) : ?\phpQueryObject
    {
        $label = $this->renderLabel();
        $hint = $this->renderFieldHint();

        if (!empty(static::$settings['labelAfter'])) {
            $elements = [$field, $hint, $label];
        } else {
            $elements = [$label, $field, $hint];
        }

        if (!$this->fieldWrapper) {
            $object = \phpQuery::pq('<div>');
            foreach ($elements as $el) {
                $object->append($el);
            }

            return $object;
        }

        $fieldWrapper = $this->fieldWrapper->render();

        foreach ($elements as $el) {
            if ($fieldWrapper) {
                $fieldWrapper->append($el);
            }
        }

        return $fieldWrapper;
    }

    /**
     * @return \phpQueryObject|null
     */
    abstract public function render() : ?\phpQueryObject;
}
