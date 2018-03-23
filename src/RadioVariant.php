<?php

namespace avtomon;

class RadioVariantException extends \Exception
{
}

class RadioVariant extends AbstractFormComponent
{
    /**
     * Текст варианта переключателя
     *
     * @var string
     */
    protected $labelText = '';

    /**
     * Имя переключателя
     *
     * @var string
     */
    protected $name = '';

    /**
     * Значение вариата переключателя
     *
     * @var string
     */
    protected $value = '';

    /**
     * Конструктор
     *
     * @param array $settings - настройки объекта
     *
     * @throws SectionException
     */
    public function __construct(array $settings)
    {
        if (empty($settings['name'])) {
            throw new SectionException('Не задано имя');
        }

        if (empty($settings['labelText'])) {
            throw new SectionException('Не задан текст метки');
        }

        parent::__construct($settings);
    }

    /**
     * Отрендерить вариант переключателя
     *
     * @return \phpQueryObject|\QueryTemplatesParse|\QueryTemplatesSource|\QueryTemplatesSourceQuery|null
     */
    public function render()
    {
        $field = phpQuery::pq('<input>')->attr('type', 'radio');
        $label = phpQuery::pq('<input>')->text($this->labelText);
        $field->after($label);
        self::renderAttributes($label, $this->attributes, ['type']);

        return $field;
    }

    /**
     * Вернуть значение переключателя
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }
}