<?php
namespace app\forms\task;

use app\forms\BaseForm;
use app\models\task\Image;
use Assert\Assertion;
use InvalidArgumentException;

class CreateForm extends BaseForm
{
    public $user;
    public $email;
    public $description;
    public $image;

    public function __construct(string $user = null, string $email = null, string $description = null, string $image = null)
    {
        $this->user = $user;
        $this->email = $email;
        $this->description = $description;
        $this->image = $image;
    }

    public function validate(): bool
    {
        try {
            Assertion::notNull($this->user);
            Assertion::string($this->user);
            Assertion::lessOrEqualThan(strlen($this->user), 32);
        } catch (InvalidArgumentException $exception) {
            $this->addError('user', $exception->getMessage());
        }

        try {
            Assertion::notNull($this->email);
            Assertion::email($this->email);
            Assertion::lessOrEqualThan(strlen($this->email), 64);
        } catch (InvalidArgumentException $exception) {
            $this->addError('email', $exception->getMessage());
        }

        try {
            Assertion::notNull($this->description);
            Assertion::string($this->description);
            Assertion::lessOrEqualThan(strlen($this->description), 1024);
        } catch (InvalidArgumentException $exception) {
            $this->addError('description', $exception->getMessage());
        }

        return !$this->hasErrors();
    }
}