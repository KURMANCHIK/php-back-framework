<?php $title = $article->getName() ?>
<?php include __DIR__ . '/../header.php'; ?>
<h1><?= $article->getName() ?></h1>
<p><?= $article->getText() ?></p>
<p>Автор: <b><?= $article->getAuthor()->getNickname() ?></b></p>

<?php if (!empty($user) && $user->getId() == $article->getAuthorId()): ?>
    <details>
        <summary>Редактировать статью</summary>
        <form action="/articles/<?= $article->getId() ?>/edit" method="post">
            <label for="name">Название</label>
            <input type="text" id="name" name="name" value="<?= $article->getName() ?>">
            <label for="text">Содержание</label>
            <textarea id="text" name="text"><?= $article->getText() ?></textarea>
            <button type="submit">Сохранить</button>
        </form>
    </details>
    <a href="/articles/<?= $article->getId() ?>/delete">Удалить статью</a>
<?php endif; ?>

<section>
    <h1>Комментарии</h1>
    <?php if (!empty($user)): ?>
        <form action="/comments/<?= $article->getId() ?>/add" method="post">
            <label for="comment">Комментарий</label>
            <textarea id="comment" name="text"></textarea>
            <input type="text" name="authorId" value="<?= $user->getId() ?>" hidden>
            <button type="submit">Отправить</button>
        </form>
    <?php else: ?>
        <p>Войдите на сайт, чтобы оставить комментарий</p>
    <?php endif; ?>

    <?php foreach ($comments as $comment): ?>
        <h2><?= $comment->getAuthor()->getNickname() ?></h2>
        <p><?= $comment->getText() ?></p>
        <?php if (!empty($user) && $user->getId() == $comment->getAuthorId()): ?>
            <details>
                <summary>Редактировать</summary>
                <form action="/comments/<?= $comment->getId() ?>/edit/<?= $article->getId() ?>" method="post">
                    <label for="comment">Комментарий</label>
                    <textarea id="comment" name="text"><?= $comment->getText() ?></textarea>
                    <button type="submit">Сохранить</button>
                </form>
            </details>
            <a href="/comments/<?= $comment->getId() ?>/delete/<?= $article->getId() ?>">Удалить</a>
        <?php endif; ?>
        <hr>
    <?php endforeach; ?>


</section>
<?php include __DIR__ . '/../footer.php'; ?>