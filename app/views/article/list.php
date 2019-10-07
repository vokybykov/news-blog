<? include_once __DIR__.'/../header.php'; ?>

<div class="container">
    <div class="row">
        <div class="col-sm text-center">
            <a class="btn-new-article" href="article/create">Create New Article</a>
        </div>
    </div>
    <div class="row">
        <div class="col-sm" id="articles">
            <?php if (!empty($articles)) {
                 foreach($articles as $article) { ?>
                     <div id="<?php echo $article['id']; ?>" class="card">
                         <div class="card-header">
                             <h5 class="card-title"><?php echo $article['title']; ?></h5>
                             <a class="btn btn-info" href="article/edit?id=<?php echo  $article['id']; ?>">Edit</a>
                             <a class="btn btn-danger deletebtn">Delete</a>
                         </div>
                         <div class="card-body">
                             <p class="card-text"><?php echo $article['content']; ?></p>
                         </div>
                     </div>
                 <?php } ?>
            <?php } else echo "No News Found..."; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm">
            <nav>
                <ul class="pagination justify-content-center">
                    <?php for ($i = 1; $i <= $pagesCounter; $i++) { ?>
                        <li class="page-item  <?php if ($i === 1) echo 'active'; ?>"><a class="page-link" id="<?php echo $i; ?>"><?php echo $i; ?></a></li>
                    <?php } ?>
                </ul>
            </nav>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Do you really want to delete this article?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <button type="button" class="btn btn-primary delete">Yes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>

<? include_once __DIR__.'/../footer.php'; ?>

<script type="text/javascript">
    $(document).ready(function() {

        $(document).on('click', '.deletebtn', function() {
            $('#deleteModal').modal('show');

            id = $(this).closest('.card').attr('id');

            $('.delete').on('click', function() {
                $.ajax({
                    url: 'article/delete?id=' + id,
                    success: function(data) {
                        page = $(".pagination .active a").attr('id');
                        getNews(page);
                        $('#deleteModal').modal('hide');
                    }
                });
            });
        });

        $('.page-link').on('click', function() {
            page = $(this).attr('id');

            $(".pagination").children().removeClass("active");
            $(this).parent().addClass("active");

            getNews(page);
        });

        function getNews(page) {
            $.ajax({
                url: '/?page=' + page,
                success: function(data) {
                    var response = JSON.parse(data);
                    var data = response.articles;
                    var pagesCounter = response.pagesCounter;

                    $('#articles').children().remove();

                    for(var x = 0;  x < data.length; x++) {
                        $('#articles').append(
                            '<div id="' + data[x].id + '" class="card">\
                                <div class="card-header">\
                                    <h5 class="card-title">' + data[x].title + '</h5>\
                                    <a class="btn btn-info" href="article/edit?id=' + data[x].id + '">Edit</a>\
                                    <a class="btn btn-danger deletebtn">Delete</a>\
                                </div>\
                                <div class="card-body">\
                                    <p class="card-text">' + data[x].content + '</p>\
                                </div>\
                            </div>');
                    }

                    if (pagesCounter != $('.pagination li').length) {
                        page = $(".pagination .active a").attr('id');
                        $('.pagination').children().remove();

                        for(var i = 1;  i <= pagesCounter; i++) {
                            $('.pagination').append('<li class="page-item">\
                                                        <a class="page-link" id="' + i + '">' + i + '</a>\
                                                    </li>');

                            if (i == page) {
                                $('.pagination').children().find('#' + i).parent().addClass('active');
                            }
                        }
                    }
                }
            });
        }

    });
</script>
