<?php
namespace App\Model\Entity;

use Core\Model\Entity;

use Core\Controller\Helpers\TextController;

class UserInfosEntity extends Entity
{
    private $id;

    private $name;

    private $email;

    private $password;

    private $created_at;

    private $userInfos = [];

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the value of slug
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Get the value of content
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Get the value of created_at
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return new \DateTime($this->created_at);
    }

    public function getExcerpt(int $lenght): string
    {
        return nl2br(htmlentities(TextController::excerpt($this->getEmail(), $lenght)));
    }

    public function getUserInfos(): array
    {
        return $this->userInfos;
    }

    public function setUserInfos(CategoryEntity $user): void
    {
        $this->userInfos[] = $user;
    }

    public function getUrl(): string
    {
        return \App\App::getInstance()
            ->getRouter()
            ->url('users', [
                "name" => $this->getName(),
                "id" => $this->getId()
            ]);
    }
}
