<?php $title = 'Регистрация' ?>
<?php include __DIR__ . '/../header.php'; ?>
<h1>Регистрация</h1>
<?= !empty($error) ? '<div class="registration__error">' . $error . '</div>' : '' ?>

<form action="/users/register" method="post">
    <label for="nickname">Никнейм</label>
    <input type="text" id="nickname" value="<?= $_POST['nickname'] ?? '' ?>" name="nickname"><br>
    <label for="email">Почта</label>
    <input type="email" id="email" value="<?= $_POST['email'] ?? '' ?>" name="email"><br>
    <label for="password">Пароль</label>
    <input type="text" id="password" value="<?= $_POST['password'] ?? '' ?>" name="password"><br>
    <button type="submit">Зарегистрироваться</button>
</form>
<?php include __DIR__ . '/../footer.php'; ?>