<?php

namespace Project\Controllers;

use Project\Exceptions\NotFoundException;
use Project\Models\Articles\Article;
use Project\Models\Comments\Comment;
use Project\Models\Users\User;


class ArticlesController extends AbstractController
{
    public function view($articleId)
    {
        $article = Article::getById($articleId);

        if ($article === null) {
            throw new NotFoundException();
        }

        $comments = Comment::loadComments($articleId);
        $this->view->renderHtml('articles/view.php', ['article' => $article, 'comments' => $comments, 'user' => $this->user]);
    }

    public function edit(int $articleId): void
    {
        $article = Article::getById($articleId);

        if ($article === null) {
            throw new NotFoundException();
        }

        $article->setName($_POST['name']);
        $article->setText($_POST['text']);

        $article->save();

        header('Location: /articles/' . $article->getId());
    }

    public function delete($articleId)
    {
        $article = Article::getById($articleId);
        $article->delete();

        header('Location: /');
    }

    public function add(): void
    {
        $article = new Article();

        $article->setAuthorId($_POST['authorId']);
        $article->setName($_POST['name']);
        $article->setText($_POST['text']);

        $article->save();

        header('Location: /');
    }
}

