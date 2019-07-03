<?php

namespace Scaleplan\Form\Fields;

use PhpQuery\PhpQuery;
use PhpQuery\PhpQueryObject;
use Scaleplan\Form\FormHelper;

/**
 * Class TemplateField
 *
 * @package Scaleplan\Form
 */
class TemplateField extends AbstractField
{
    /**
     * Расширение файлов шаблонов полей
     */
    protected const TEMPLATE_EXTENSION = 'html';

    /**
     * Путь к директории с шаблонами полей
     *
     * @var string
     */
    protected $templatePath = '/bundles/app/Views/private/forms/templates';

    /**
     * Имя файла шаблона поля
     *
     * @var string
     */
    protected $template = '';

    /**
     * PhpQuery-объект шаблона поля
     *
     * @var null|PhpQueryObject
     */
    protected $renderedTemplate;

    /**
     * Установить шаблон поля
     *
     * @param string $template
     */
    public function setTemplate(string $template) : void
    {
        if (!$template) {
            return;
        }

        if (!preg_match('/.+\.' . static::TEMPLATE_EXTENSION . '$/', $template)) {
            $template = "$template." . static::TEMPLATE_EXTENSION;
        }

        $this->template = $template;
    }

    /**
     * Установить путь до директории с шаблонами полей
     *
     * @param string $templatePath - путь
     */
    public function setTemplatePath(string $templatePath) : void
    {
        $this->templatePath = $templatePath;
    }

    /**
     * Отрендерить поле представленное шаблоном
     *
     * @return null|PhpQueryObject
     *
     * @throws \Exception
     */
    public function render() : ?PhpQueryObject
    {
        if (empty($this->templatePath) || empty($this->template)) {
            return null;
        }

        $renderedTemplate = PhpQuery::newDocumentFileHTML(
            $_SERVER['DOCUMENT_ROOT'] . $this->templatePath . '/' . $this->template
        );
        $renderedTemplate->find('*[data-view]')->attr('data-view', $this->name);
        $field = $renderedTemplate->find('select, input, textarea')->filter(':first');
        $field->val($this->value);
        $field->attr('name', $this->name);
        $renderedTemplate->find('label')->text($this->labelText);
        FormHelper::renderAttributes($field, $this->attributes);

        return $renderedTemplate;
    }
}
