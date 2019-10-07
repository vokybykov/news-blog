<? include_once __DIR__.'/../header.php'; ?>

<div class="container">
    <div class="row">
        <div class="col-sm">
            <a class="btn btn-back" href="/">&laquo; Back</a>
        </div>
    </div>
    <div class="row">
        <div class="col-sm">
            <h2>New Article</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-sm">
            <form method="post">
                <div class="form-group">
                    <label for="title">Title: </label>
                    <input type="text" name="title" class="form-control" id="title" placeholder="Title" required>
                </div>
                <div class="form-group">
                    <label for="content">Content: </label>
                    <textarea name="content" class="form-control" id="content" placeholder="Article content..." required></textarea>
                </div>
                <button type="submit" class="btn btn-primary" name="save" id="save">Save</button>
            </form>
        </div>
    </div>
</div>

<? include_once __DIR__.'/../footer.php'; ?>
