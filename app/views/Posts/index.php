<h1>Posts index page</h1>
<?php foreach ($posts as $post): ?>
<?php if ($post->image): ?>
<p><img src="/images/<?= $post->image ?>"></p>
<?php endif ?>
<p><?= $post->name ?></p>
<p><?=  mb_strimwidth($post->body , 0, 100, "...") ?></p>
<p><a href="/post/<?= $post->id ?>">view</a>
    | <a href="/post/edit/<?= $post->id ?>">edit</a>

    | <form action="/post/delete" method="post">
        <input type="hidden" name="id" value="<?= $post->id ?>">
        <input type="submit" value="delete" />
    </form>
<?php endforeach ?>
