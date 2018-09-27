<?php
namespace app\models\task;

use app\models\BaseModel;

class Task extends BaseModel
{
    /**
     * @var Id
     */
    protected $id;

    /**
     * @var User
     */
    protected $user;

    /**
     * @var Email
     */
    protected $email;

    /**
     * @var Description
     */
    protected $description;

    /**
     * @var Image
     */
    protected $image;

    /**
     * @var Done
     */
    protected $done;

    public function __construct(Id $id, User $user, Email $email, Description $description, Image $image, Done $done)
    {
        $this->id = $id;
        $this->user = $user;
        $this->email = $email;
        $this->description = $description;
        $this->image = $image;
        $this->done = $done;
    }

    /**
     * @return Id
     */
    public function getId(): Id
    {
        return $this->id;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @return Email
     */
    public function getEmail(): Email
    {
        return $this->email;
    }

    /**
     * @return Description
     */
    public function getDescription(): Description
    {
        return $this->description;
    }


    public function updateDescription(Description $description): void
    {
        $this->description = $description;
    }

    /**
     * @return Image
     */
    public function getImage(): Image
    {
        return $this->image;
    }

    /**
     * @return Done
     */
    public function getDone(): Done
    {
        return $this->done;
    }

    public function updateDone(Done $done): void
    {
        $this->done = $done;
    }
}