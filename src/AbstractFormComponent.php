<?php

namespace avtomon;

use phpQuery;

class AbstractFormComponent
{
    use InitTrait;

    /**
     * Атрибуты элемента формы
     *
     * @var array|void
     */
    protected $attributes = [];

    /**
     * Коструктор
     *
     * @param array $settings - настройки объекта
     */
    public function __construct(array $settings)
    {
        $this->attributes = $this->initObject($settings + self::$settings);
    }

    /**
     * Установить значения атрибутов
     *
     * @param array $attributes - массив атрибутов
     */
    public function setAttributes(array $attributes)
    {
        $this->attributes = $attributes;
    }

    /**
     * Добавить атрибут
     *
     * @param string $name - имя атрибута
     * @param $value - значение атрибута
     */
    public function addAttribute(string $name, $value)
    {
        $this->attributes[$name] = $value;
    }

    /**
     * Превратить объект в HTML-разметку
     * 
     * @return mixed
     */
    public abstract function render();

    /**
     * Вернуть объект как строку
     *
     * @return mixed
     */
    public function __toString()
    {
        return $this->render();
    }
}