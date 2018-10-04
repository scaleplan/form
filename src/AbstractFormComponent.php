<?php

namespace Scaleplan\Form;

use Scaleplan\InitTrait\InitTrait;

/**
 * Базовый класс компанентов формы
 *
 * Class AbstractFormComponent
 *
 * @package Scaleplan\Form
 */
abstract class AbstractFormComponent
{
    use InitTrait;

    /**
     * Атрибуты элемента формы
     *
     * @var array
     */
    protected $attributes = [];

    /**
     * Конструктор
     *
     * @param array $settings - настройки объекта
     *
     * @throws \ReflectionException
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
    public function setAttributes(array $attributes): void
    {
        $this->attributes = array_map(function ($attribute) {
            return (string) $attribute;
        }, $attributes);
    }

    /**
     * Добавить атрибут
     *
     * @param string $name - имя атрибута
     * @param string $value - значение атрибута
     */
    public function addAttribute(string $name, $value): void
    {
        $this->attributes[$name] = (string) $value;
    }

    /**
     * Превратить объект в HTML-разметку
     * 
     * @return mixed
     */
    abstract public function render();

    /**
     * Вернуть объект как строку
     *
     * @return string
     */
    public function __toString(): string
    {
        return (string) $this->render();
    }
}