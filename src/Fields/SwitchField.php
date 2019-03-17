<?php

namespace Scaleplan\Form\Fields;

/**
 * Class SwitchField
 *
 * @package Scaleplan\Form
 */
class SwitchField extends AbstractField
{
    /**
     * Варианты радио-баттона
     *
     * @var Variant[]
     */
    protected $variants = [];

    /**
     * SwitchField constructor.
     *
     * @param array $settings
     *
     * @throws \Scaleplan\Form\Exceptions\FieldException
     * @throws \Scaleplan\Form\Exceptions\RadioVariantException
     */
    public function __construct(array $settings)
    {
        if (!empty($settings['variants']) && \is_array($settings['variants'])) {
            foreach ($settings['variants'] as &$variant) {
                $variant = new Variant($variant);
            }

            unset($variant);
        }

        parent::__construct($settings);
    }

    /**
     * Установить варианты выбора переключателя
     *
     * @param array $variants - список объектов вариантов
     */
    public function setVariants(array $variants): void
    {
        foreach ($variants as $variant) {
            if (!($variant instanceof Variant)) {
                continue;
            }

            $this->variants[] = $variant;
        }
    }

    /**
     * Добавить вариант выбора переключателя
     *
     * @param Variant $variant - добавляемый вариант
     */
    public function addVariant(Variant $variant): void
    {
        $this->variants[] = $variant;
    }

    /**
     * Отрендерить переключатель
     *
     * @return null|\phpQueryObject
     *
     * @throws \Exception
     */
    public function render() : ?\phpQueryObject
    {
        if (!\in_array($this->type, ['radio', 'checkbox'], true)) {
            return null;
        }

        /** @var \phpQueryObject $field */
        $field = array_shift($this->variants)->render();

        foreach ($this->variants as $variant) {
            if ($variant->getValue() === $this->value) {
                $variant->addAttribute('checked', 'checked');
            }

            $field->after($variant->render());
        }

        return $this->renderEnding($field);
    }
}
