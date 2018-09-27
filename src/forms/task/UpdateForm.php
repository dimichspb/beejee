<?php
namespace app\forms\task;

use app\forms\BaseForm;
use app\models\task\Image;
use Assert\Assertion;
use InvalidArgumentException;

class UpdateForm extends BaseForm
{
    public $description;
    public $done;

    public function __construct(string $description = null, bool $done = false)
    {
        $this->description = $description;
        $this->done = $done;
    }

    public function validate(): bool
    {
        $this->done = $this->done == true;

        try {
            Assertion::notNull($this->description);
            Assertion::string($this->description);
            Assertion::lessOrEqualThan(strlen($this->description), 1024);
        } catch (InvalidArgumentException $exception) {
            $this->addError('description', $exception->getMessage());
        }

        try {
            Assertion::notNull($this->done);
            Assertion::boolean($this->done);
        } catch (InvalidArgumentException $exception) {
            $this->addError('done', $exception->getMessage());
        }

        return !$this->hasErrors();
    }
}