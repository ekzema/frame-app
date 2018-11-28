<h1>Posts index page</h1>
<?php foreach ($posts as $post): ?>
<p><?php echo $post->name ?></p>
<p><?php echo $post->body ?></p>
<p><img src="/images/<?= $post->image ?>"></p>
<?php endforeach?>
