<h1>Posts index page</h1>
<?php foreach ($posts as $post): ?>
<p><img src="/images/<?= $post->image ?>"></p>
<p><?php echo $post->name ?></p>
<p><?php echo mb_strimwidth($post->body , 0, 100, "...")?></p>
<p><a href="/post/<?= $post->id ?>">view</a>
    | <a href="/post/edit/<?= $post->id ?>">edit</a>

    | <form action="/post/delete" method="post">
        <input type="hidden" name="id" value="<?= $post->id ?>">
        <input type="submit" value="delete" />
    </form>
<?php endforeach?>
