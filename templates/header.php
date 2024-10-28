<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title : "PHP Framework" ?></title>
</head>

<body>
    <header>
        <?php if (!empty($user)): ?>
            <div style="display: flex; gap: 20px">
                <p>Привет, <?= $user->getNickname() ?></p> | <a href="/users/logout">Выйти</a>
            </div>
        <?php else: ?>
            <a href="/users/login">Вход</a> | <a href="/users/register">Регистрация</a>
        <?php endif; ?>

        <nav>
            <ul>
                <li><a href="/">Главная</a></li>
            </ul>
        </nav>
    </header>