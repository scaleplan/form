<?php

namespace Scaleplan\Form;

use PhpQuery\PhpQuery;
use PhpQuery\PhpQueryObject;
use Scaleplan\Form\Exceptions\MenuException;
use function Scaleplan\Translator\translate;

/**
 * Класс элементов меню
 *
 * Class MenuElement
 *
 * @package Scaleplan\Form
 */
class MenuElement extends AbstractFormComponent
{
    /**
     * Настройки объекта по умолчанию
     *
     * @var array
     */
    protected static $settings = [
        'tag' => 'a',
    ];

    /**
     * Текст элемента меню
     *
     * @var string
     */
    protected $text = '';

    /**
     * Тег элемента меню
     *
     * @var string
     */
    protected $tag = 'a';

    /**
     * Хэш ссылки, если элемента меню - ссылка
     *
     * @var string
     */
    protected $hash = '';

    /**
     * MenuElement constructor.
     *
     * @param array $settings - настройки объекта
     *
     * @throws MenuException
     * @throws \ReflectionException
     * @throws \Scaleplan\DependencyInjection\Exceptions\ContainerTypeNotSupportingException
     * @throws \Scaleplan\DependencyInjection\Exceptions\DependencyInjectionException
     * @throws \Scaleplan\DependencyInjection\Exceptions\ParameterMustBeInterfaceNameOrClassNameException
     * @throws \Scaleplan\DependencyInjection\Exceptions\ReturnTypeMustImplementsInterfaceException
     */
    public function __construct(array $settings)
    {
        if (empty($settings['text'])) {
            throw new MenuException(translate('form.menu-item-name-not-set'));
        }

        parent::__construct($settings);
    }

    /**
     * Установить хэш элемента меню
     *
     * @param string $hash - хэш
     *
     * @throws MenuException
     * @throws \ReflectionException
     * @throws \Scaleplan\DependencyInjection\Exceptions\ContainerTypeNotSupportingException
     * @throws \Scaleplan\DependencyInjection\Exceptions\DependencyInjectionException
     * @throws \Scaleplan\DependencyInjection\Exceptions\ParameterMustBeInterfaceNameOrClassNameException
     * @throws \Scaleplan\DependencyInjection\Exceptions\ReturnTypeMustImplementsInterfaceException
     */
    public function setHash(string $hash) : void
    {
        if (!preg_match('/^#[\w-]+$/', $hash)) {
            throw new MenuException(translate('form.wrong-hash-format'));
        }

        $this->hash = $hash;
    }

    /**
     * Установить текст элемента меню
     *
     * @param string $text - текст
     */
    public function setText(string $text) : void
    {
        $this->text = strip_tags(trim($text));
    }

    /**
     * Отрендерить элемент меню
     *
     * @return PhpQueryObject|null
     *
     * @throws \Exception
     */
    public function render() : ?PhpQueryObject
    {
        $menuEl = PhpQuery::pq("<{$this->tag}>");
        $menuEl->text($this->text);
        $menuEl->attr('href', $this->hash);

        FormHelper::renderAttributes($menuEl, $this->attributes);

        return $menuEl;
    }
}
