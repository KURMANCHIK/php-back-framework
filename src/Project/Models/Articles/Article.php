<?php

namespace Project\Models\Articles;

use Project\Models\ActiveRecordEntity;
use Project\Models\Users\User;


class Article extends ActiveRecordEntity
{
    protected $name;
    protected $text;
    protected $authorId;
    protected $createdAt;

    // Getters
    public function getName()
    {
        return $this->name;
    }

    public function getText()
    {
        return $this->text;
    }

    public function getAuthorId()
    {
        return $this->authorId;
    }

    public function getAuthor(): User
    {
        return User::getById($this->authorId);
    }

    // Setters
    public function setName($name)
    {
        $this->name = $name;
    }

    public function setAuthor(User $user)
    {
        $this->authorId = $user->getId();
    }

    public function setAuthorId($authorId)
    {
        $this->authorId = $authorId;
    }

    public function setText($text)
    {
        $this->text = $text;
    }


    // Table name
    protected static function getTableName(): string
    {
        return 'articles';
    }
}