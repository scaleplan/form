<?php

namespace Scaleplan\Form;

use Scaleplan\Form\Interfaces\RenderInterface;
use Scaleplan\InitTrait\InitTrait;

/**
 * Базовый класс компанентов формы
 *
 * Class AbstractFormComponent
 *
 * @package Scaleplan\Form
 */
abstract class AbstractFormComponent implements RenderInterface
{
    use InitTrait;

    /**
     * Атрибуты элемента формы
     *
     * @var array
     */
    protected $attributes = [];

    /**
     * AbstractFormComponent constructor.
     *
     * @param array $settings - настройки объекта
     */
    public function __construct(array $settings)
    {
        $this->attributes = $this->initObject($settings);
    }

    /**
     * Установить значения атрибутов
     *
     * @param array $attributes - массив атрибутов
     */
    public function setAttributes(array $attributes) : void
    {
        $this->attributes = $attributes;
    }

    /**
     * Добавить атрибут
     *
     * @param string $name - имя атрибута
     * @param string $value - значение атрибута
     */
    public function addAttribute(string $name, $value) : void
    {
        $this->attributes[$name] = (string)$value;
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
     * Установить значение атрибута
     *
     * @param string $name - имя атрибута
     * @param $value - значение атрибута
     */
    public function setAttribute(string $name, $value) : void
    {
        $this->attributes[$name] = $value;
    }

    /**
     * Удалить атрибут
     *
     * @param string $name - имя атрибута
     */
    public function removeAttribute(string $name) : void
    {
        unset($this->attributes[$name]);
    }

    /**
     * Превратить объект в HTML-разметку
     *
     * @return \phpQueryObject|null
     */
    abstract public function render() : ?\phpQueryObject;

    /**
     * Вернуть объект как строку
     *
     * @return string
     */
    public function __toString() : string
    {
        return (string)$this->render();
    }
}
