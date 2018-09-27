<?php
namespace app\forms;

abstract class BaseForm
{
    protected $_errors = [];

    abstract public function validate(): bool;

    protected function addError($attribute, $message): void
    {
        $this->_errors[$attribute][] = $message;
    }

    public function hasError($attribute):bool
    {
        return (isset($this->_errors[$attribute])) && (count($this->_errors[$attribute]) > 0);
    }

    public function hasErrors(): bool
    {
        return count($this->_errors) > 0;
    }

    public function getErrors(): array
    {
        return $this->_errors;
    }

    public function load(array $attributes = []): bool
    {
        $result = false;
        foreach ($attributes as $attributeName => $attributeValue) {
            if (property_exists($this, $attributeName)) {
                $this->$attributeName = $attributeValue;
                $result = true;
            }
        }
        return $result;
    }
}