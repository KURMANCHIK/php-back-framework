<?php $title = 'Мой блог' ?>
<?php include __DIR__ . '/../header.php'; ?>
<?php if (!empty($user)): ?>
    <fieldset>
        Создать статью
        <form action="/articles/add" method="post">
            <label for="articleName">Название Статьи</label>
            <input type="text" name="name" id="articleName">
            <label for="articleText">Текст статьи</label>
            <textarea name="text" id="articleText"></textarea>
            <input type="text" name="authorId" value="<?= $user->getId() ?>" hidden>
            <button type="submit">Создать</button>
        </form>
    </fieldset>
<?php endif; ?>

<?php foreach ($articles as $article): ?>
    <h2><a href="/articles/<?= $article->getId() ?>"><?= $article->getName() ?></a></h2>
    <p><?= $article->getText() ?></p>
    <hr>
<?php endforeach; ?>
<?php include __DIR__ . '/../footer.php'; ?>