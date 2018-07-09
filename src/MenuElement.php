<?php

namespace avtomon;

use phpQuery;

/**
 * Класс ошибки
 *
 * Class MenuElementException
 * @package avtomon
 */
class MenuElementException extends CustomException
{
}

/**
 * Класс элементов меню
 *
 * Class MenuElement
 * @package avtomon
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
     * @throws MenuElementException
     * @throws \ReflectionException
     */
    public function __construct(array $settings)
    {
        if (empty($settings['text'])) {
            throw new MenuElementException('Не задан текст элемента меню');
        }

        parent::__construct($settings);
    }

    /**
     * Установить хэш элемента меню
     *
     * @param string $hash - хэш
     *
     * @throws MenuElementException
     */
    public function setHash(string $hash): void
    {
        if (!preg_match('/^#[\w-]+$/', $hash)) {
            throw new MenuElementException('Неверный формат хэша');
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
     * @return \phpQueryObject|\QueryTemplatesParse|\QueryTemplatesSource|\QueryTemplatesSourceQuery|null
     *
     * @throws \Exception
     */
    public function render()
    {
        $menuEl = phpQuery::pq("<{$this->tag}>")
            ->text($this->text)
            ->attr('href', $this->hash);
        FormHelper::renderAttributes($menuEl, $this->attributes);

        return $menuEl;
    }
}