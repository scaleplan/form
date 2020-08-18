<?php

namespace Scaleplan\Form\Fields;

use PhpQuery\PhpQuery;
use PhpQuery\PhpQueryObject;
use Scaleplan\Form\Exceptions\FieldException;
use Scaleplan\Form\FormHelper;
use Scaleplan\Main\App;
use function Scaleplan\DependencyInjection\get_required_static_container;
use function Scaleplan\Helpers\get_required_env;
use Scaleplan\Main\Constants\ConfigConstants;
use function Scaleplan\Translator\translate;

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
    protected $templatePath = '/templates';

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
     * TemplateField constructor.
     *
     * @param array $settings
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
        if (empty($settings['template'])) {
            throw new FieldException(translate('form.template-file-not-set'));
        }

        $this->attributes = $this->initObject($settings);
    }

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

        /** @var App $app */
        $app = get_required_static_container(App::class);
        $renderedTemplate = PhpQuery::newDocumentFileHTML(
            get_required_env(ConfigConstants::BUNDLE_PATH)
            . get_required_env(ConfigConstants::VIEWS_PATH)
            . get_required_env('FORM_PATH')
            . '/'
            . $app::getLocale()
            . $this->templatePath
            . '/' . $this->template
        );
        $dataView = $renderedTemplate->find('*[data-view]');
        $dataView && $dataView->attr('data-view', $this->name);
        $field = $renderedTemplate->find('select, input, textarea')->filter(':first');
        $this->value && $field->val($this->value);
        $this->name && $field->attr('name', $this->name);
        $this->labelText && $renderedTemplate->find('label')->text($this->labelText);

        FormHelper::renderAttributes($field, $this->attributes);

        return $renderedTemplate;
    }
}
