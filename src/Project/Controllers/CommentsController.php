<?php

namespace Project\Controllers;

use Project\Controllers\AbstractController;
use Project\Models\Comments\Comment;


class CommentsController extends AbstractController
{
    public function add(int $articleId)
    {
        $comment = new Comment();
        $comment->setArticleId($articleId);
        $comment->setAuthorId($_POST['authorId']);
        $comment->setText($_POST['text']);

        $comment->saveComment($_POST['authorId'], $articleId, $_POST['text']);

        header('Location: /articles/' . $articleId);
    }

    public function delete(int $commentId, $articleId)
    {
        $comment = Comment::getById($commentId);
        
        header('Location: /articles/' . $articleId);
        
        $comment->delete();
    }

    public function edit(int $commentId, $articleId)
    {
        $comment = Comment::getById($commentId);
        $comment->editComment($_POST['text'], $commentId);
        header('Location: /articles/' . $articleId);
    }
}
