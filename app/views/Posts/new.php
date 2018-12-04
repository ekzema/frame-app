<div class="row">
    <div class="col-md-12">
        <h1>Post new page</h1>
        <form enctype="multipart/form-data" action="/posts/add" method="post">
            <div class="form-group">
                <label for="name">Name</label>
                <input id="name" class="form-control" type="text" name="name">
            </div>
            <div class="form-group">
                <label for="body">Body</label>
                <textarea id="body" class="form-control" rows="10" cols="45" name="body"></textarea>
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input id="image" class="form-control" type="file" name="image">
            </div>
            <input type="submit" row="5">
        </form>
    </div>
</div>
