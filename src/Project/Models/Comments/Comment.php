<?php

namespace Project\Models\Comments;

use Project\Models\ActiveRecordEntity;
use Project\Models\Users\User;


class Comment extends ActiveRecordEntity
{
    protected $text;
    protected $articleId;
    protected $authorId;
    protected $createdAt;

    // Getters
    public function getText()
    {
        return $this->text;
    }

    public function getAuthorId()
    {
        return $this->authorId;
    }
    
    public function getArticleId()
    {
        return $this->articleId;
    }

    public function getAuthor(): User
    {
        return User::getById($this->authorId);
    }

    // Setters
    public function setText($text)
    {
        $this->text = $text;
    }
    
    public function setAuthorId($authorId)
    {
        $this->authorId = $authorId;
    }
    
    public function setArticleId($articleId)
    {
        $this->articleId = $articleId;
    }
    

    // Table name
    protected static function getTableName(): string
    {
        return 'comments';
    }
}