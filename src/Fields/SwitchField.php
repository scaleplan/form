<?php

namespace Scaleplan\Form\Fields;

use phpQuery;
use Scaleplan\Form\Exceptions\FieldException;

/**
 * Class SwitchField
 *
 * @package Scaleplan\Form
 */
class SwitchField extends AbstractField
{
    public const ALLOWED_TYPES = [self::RADIO, self::CHECKBOX,];

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
    public function setVariants(array $variants) : void
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
    public function addVariant(Variant $variant) : void
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
        $value = $this->value;
        if (\is_array($this->value)) {
            $this->setType(self::CHECKBOX);
        } else {
            $this->setType(self::RADIO);
            $value = [$value];
        }

        foreach ($this->variants as $index => $variant) {
            $variant->setType($this->type);
            $variant->setName($this->name);

            if (\in_array($variant->getValue(), $value, true)) {
                $variant->setChecked(true);
            }
        }

        $variants = [];
        foreach ($this->variants as $variant) {
            $variants[] = $variant->render();
        }

        return $this->renderEnding($variants);
    }
}
