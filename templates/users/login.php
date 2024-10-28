<?php $title = 'Вход' ?>
<?php include __DIR__ . '/../header.php'; ?>
<h1>Вход</h1>
<?= !empty($error) ? '<div class="registration__error">' . $error . '</div>' : '' ?>

<form action="/users/login" method="post">
    <label for="email">Почта</label>
    <input type="email" id="email" value="<?= $_POST['email'] ?? '' ?>" name="email"><br>
    <label for="password">Пароль</label>
    <input type="text" id="password" value="<?= $_POST['password'] ?? '' ?>" name="password"><br>
    <button type="submit">Войти</button>
</form>

<a href="/users/register">Регистрация</a>
<?php include __DIR__ . '/../footer.php'; ?>