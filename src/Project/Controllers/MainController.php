<?php

namespace Project\Controllers;

use Project\Controllers\AbstractController;
use Project\Models\Articles\Article;


class MainController extends AbstractController
{
    public function main()
    {
        $articles = Article::findAll();
        $this->view->renderHtml('main/main.php', ['articles' => $articles, 'user' => $this->user]);
    }


    // Training
    public function sayHello(string $name)
    {
        $this->view->renderHtml('main/hello.php', ['name' => $name]);
    }

    public function sayBye(string $name)
    {
        $this->view->renderHtml('main/bye.php', ['name' => $name]);
    }
}
