<?php
declare(strict_types=1);

namespace Scaleplan\Form\Fields;

use PhpQuery\PhpQuery;
use PhpQuery\PhpQueryObject;
use Scaleplan\Form\AbstractFormComponent;
use Scaleplan\Form\Exceptions\FieldException;
use function Scaleplan\Translator\translate;

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

    public const TEXT           = 'text';
    public const SELECT         = 'select';
    public const TEXTAREA       = 'textarea';
    public const RADIO          = 'radio';
    public const PASSWORD       = 'password';
    public const FILE           = 'file';
    public const CHECKBOX       = 'checkbox';
    public const DATE           = 'date';
    public const DATETIME       = 'datetime';
    public const COLOR          = 'color';
    public const DATETIME_LOCAL = 'datetime-local';
    public const EMAIL          = 'email';
    public const NUMBER         = 'number';
    public const RANGE          = 'range';
    public const SEARCH         = 'search';
    public const TEL            = 'tel';
    public const TIME           = 'time';
    public const URL            = 'url';
    public const MONTH          = 'month';
    public const WEEK           = 'week';
    public const HIDDEN         = 'hidden';
    public const TEMPLATE       = 'template';

    /**
     * Доступные виды полей ввода
     */
    public const ALLOWED_TYPES = [
        self::TEXT,
        self::SELECT,
        self::TEXTAREA,
        self::RADIO,
        self::PASSWORD,
        self::FILE,
        self::CHECKBOX,
        self::DATE,
        self::DATETIME,
        self::COLOR,
        self::DATETIME_LOCAL,
        self::EMAIL,
        self::NUMBER,
        self::RANGE,
        self::SEARCH,
        self::TEL,
        self::TIME,
        self::URL,
        self::MONTH,
        self::WEEK,
        self::HIDDEN,
        self::TEMPLATE,
    ];

    /**
     * Тип поля
     *
     * @var string
     */
    protected $type = self::TEXT;

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
     * @var string|array
     */
    protected $value;

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
     * Поставить метку после поля
     *
     * @var bool
     */
    protected $labelAfter;

    /**
     * AbstractField constructor.
     *
     * @param array $settings - настройки объекта
     *
     * @throws FieldException
     * @throws \ReflectionException
     * @throws \Scaleplan\DependencyInjection\Exceptions\ContainerTypeNotSupportingException
     * @throws \Scaleplan\DependencyInjection\Exceptions\DependencyInjectionException
     * @throws \Scaleplan\DependencyInjection\Exceptions\ParameterMustBeInterfaceNameOrClassNameException
     * @throws \Scaleplan\DependencyInjection\Exceptions\ReturnTypeMustImplementsInterfaceException
     */
    public function __construct(array $settings)
    {
        if (empty($settings['type'])) {
            throw new FieldException(translate('form.field-type-not-set'));
        }

        $this->setType($settings['type']);

        if (empty($settings['name'])) {
            throw new FieldException(translate('form.field-name-not-set'));
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
     * @throws \ReflectionException
     * @throws \Scaleplan\DependencyInjection\Exceptions\ContainerTypeNotSupportingException
     * @throws \Scaleplan\DependencyInjection\Exceptions\DependencyInjectionException
     * @throws \Scaleplan\DependencyInjection\Exceptions\ParameterMustBeInterfaceNameOrClassNameException
     * @throws \Scaleplan\DependencyInjection\Exceptions\ReturnTypeMustImplementsInterfaceException
     */
    public function setType(string $type) : void
    {
        if (!\in_array($type, static::ALLOWED_TYPES, true)) {
            throw new FieldException(translate('form.field-type-not-supported', ['type' => $type,]));
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
        $this->value = $value;
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
     * Отрендерить подсказку поля
     *
     * @return null|PhpQueryObject
     *
     * @throws \Exception
     */
    protected function renderFieldHint() : ?PhpQueryObject
    {
        if (empty($this->hint)) {
            return null;
        }

        $hint = PhpQuery::pq($this->hintHTML);

        return $hint->attr($this->hintAttribute, $this->hint);
    }

    /**
     * Рендеринг метки поля
     *
     * @return null|PhpQueryObject
     *
     * @throws \Exception
     */
    protected function renderLabel() : ?PhpQueryObject
    {
        if (empty($this->labelText)) {
            return null;
        }

        $label = PhpQuery::pq('<label>');
        $label->text($this->labelText);
        $label->attr('for', $this->attributes['id']);

        return $label;
    }

    /**
     * @param PhpQueryObject|PhpQueryObject[] $field
     *
     * @return null|PhpQueryObject
     *
     * @throws \Exception
     */
    protected function renderEnding($field) : ?PhpQueryObject
    {
        $label = $this->renderLabel();
        $hint = $this->renderFieldHint();

        if (!empty($this->labelAfter ?? static::$settings['labelAfter'])) {
            $elements = [$field, $hint, $label];
        } else {
            $elements = [$label, $field, $hint];
        }

        $append = static function ($el, PhpQueryObject $parent) {
            if (null === $el) {
                return $parent;
            }

            if (!\is_array($el)) {
                $parent->append($el);
            }

            foreach ($el as $variant) {
                $parent->append($variant);
            }

            return $parent;
        };

        if (!$this->fieldWrapper) {
            $parent = PhpQuery::pq('<div>');
            foreach ($elements as $el) {
                $append($el, $parent);
            }

            return $parent;
        }

        $fieldWrapper = $this->fieldWrapper->render();

        foreach ($elements as $el) {
            if ($fieldWrapper && $el) {
                $append($el, $fieldWrapper);
            }
        }

        return $fieldWrapper;
    }

    /**
     * @return PhpQueryObject|null
     */
    abstract public function render() : ?PhpQueryObject;
}
