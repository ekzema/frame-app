<div class="row">
    <div class="col-md-12">
        <h1>Post edit page</h1>
        <form enctype="multipart/form-data" action="/post/update/<?= $post->id ?>" method="post">
            <div class="form-group">
                <label for="image">Image</label>
                <?php if ($post->image):?>
                    <p><img src="/images/<?= $post->image ?>"></p>
                <?php endif ?>
                <input id="image" class="form-control" type="file" name="image">
            </div>
            <div class="form-group">
                <label for="name">Name</label>
                <input id="name" class="form-control" type="text" name="name" value="<?= $post->name ?>">
            </div>
            <div class="form-group">
                <label for="body">Body</label>
                <textarea id="body" class="form-control" rows="10" cols="45" name="body"><?= $post->body ?></textarea>
            </div>
            <input type="submit" row="5">
        </form>
    </div>
</div>