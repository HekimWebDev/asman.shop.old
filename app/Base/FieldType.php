<?php

namespace App\Base;

interface FieldType
{
    /**
     * Return the field type value.
     *
     * @return mixed
     */
    public function getValue(): mixed;

    /**
     * Set the value for the field type.
     *
     * @param mixed $value
     *
     * @return void
     */
    public function setValue(mixed $value): void;

    /**
     * Return the display label for the field type.
     *
     * @return string
     */
    public function getLabel(): string;

    /**
     * Return the config for the field type.
     *
     * @return array
     */
    public function getConfig(): array;

    /**
     * Return the reference to the view used in the settings.
     */
    public function getSettingsView(): string;

    /**
     * Return the view used in editing.
     *
     * @return string
     */
    public function getView(): string;
}
