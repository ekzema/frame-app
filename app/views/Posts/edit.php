<h1>Post edit page</h1>
<form enctype="multipart/form-data" action="/post/update/<?= $post->id ?>" method="post">
    <b>image</b>
    <?php if ($post->image):?>
        <p><img src="/images/<?= $post->image ?>"></p>
    <?php endif ?>
    <p><input type="file" name="image"></p>
    <b>Name</b>
    <p><input type="text" name="name" value="<?= $post->name ?>"></p>
    <b>body</b>
    <p><textarea rows="10" cols="45" name="body"><?= $post->body ?></textarea></p>
    <input type="submit" row="5">
</form>