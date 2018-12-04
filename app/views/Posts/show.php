<h1>Post show page</h1>
<?php if ($post->image): ?>
    <p><img src="/images/<?= $post->image ?>"></p>
<?php endif ?>
<p><?= $post->name ?></p
<p><?= $post->body ?></p