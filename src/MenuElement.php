<?php

namespace Scaleplan\Form;

use phpQuery;
use Scaleplan\Form\Exceptions\MenuException;

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
        'tag' => 'a'
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
     * Конструктор
     *
     * @param array $settings - настройки объекта
     *
     * @throws MenuException
     */
    public function __construct(array $settings)
    {
        if (empty($settings['text'])) {
            throw new MenuException('Не задан текст элемента меню');
        }

        parent::__construct($settings);
    }

    /**
     * Установить хэш элемента меню
     *
     * @param string $hash - хэш
     *
     * @throws MenuException
     */
    public function setHash(string $hash): void
    {
        if (!preg_match('/^#[\w-]+$/', $hash)) {
            throw new MenuException('Неверный формат хэша');
        }

        $this->hash = $hash;
    }

    /**
     * Установить текст элемента меню
     *
     * @param string $text - текст
     */
    public function setText(string $text): void
    {
        $this->text = strip_tags(trim($text));
    }

    /**
     * Отрендерить элемент меню
     *
     * @return \phpQueryObject|null
     *
     * @throws \Exception
     */
    public function render() : ?\phpQueryObject
    {
        $menuEl = phpQuery::pq("<{$this->tag}>");
        $menuEl->text($this->text);
        $menuEl->attr('href', $this->hash);

        FormHelper::renderAttributes($menuEl, $this->attributes);

        return $menuEl;
    }
}
