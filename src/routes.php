<?php

return [
    '~^comments/(\d+)/delete/(\d+)$~' => [Project\Controllers\CommentsController::class, 'delete'],
    '~^comments/(\d+)/edit/(\d+)$~' => [Project\Controllers\CommentsController::class, 'edit'],
    '~^comments/(\d+)/add$~' => [Project\Controllers\CommentsController::class, 'add'],
    '~^users/(\d+)/activate/(.+)$~' => [Project\Controllers\UsersController::class, 'activate'],
    '~^users/register$~' => [Project\Controllers\UsersController::class, 'signUp'],
    '~^users/logout$~' => [Project\Controllers\UsersController::class, 'logout'],
    '~^users/login$~' => [Project\Controllers\UsersController::class, 'login'],
    '~^articles/(\d+)/delete$~' => [Project\Controllers\ArticlesController::class, 'delete'],
    '~^articles/(\d+)/edit$~' => [Project\Controllers\ArticlesController::class, 'edit'],
    '~^articles/(\d+)$~' => [Project\Controllers\ArticlesController::class, 'view'],
    '~^articles/add$~' => [Project\Controllers\ArticlesController::class, 'add'],
    '~^hello/(.*)$~' => [Project\Controllers\MainController::class, 'sayHello'],
    '~^bye/(.*)$~' => [Project\Controllers\MainController::class, 'sayBye'],
    '~^$~' => [Project\Controllers\MainController::class, 'main'],
];