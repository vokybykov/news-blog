<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Models\Article;
use App\Core\View;

class ArticleController extends Controller {

    public function index() {
        $article = new Article();
        $allArticles = $article->getAllArticles();
        $pagesCounter = ceil(count($allArticles) / 10);

        if (!empty($_GET['page'])) {
            $currentPosition = $_GET['page'] * 10 - 10;
            $articles['articles'] = $article->getArticlesWithPagination($currentPosition);
            $articles['pagesCounter'] = $pagesCounter;
            echo json_encode($articles);
        } else {
            $currentPosition = 0;
            $articles = $article->getArticlesWithPagination($currentPosition);
            View::render('article.list', ['articles' => $articles,
                                                'pagesCounter' => $pagesCounter]);
        }
    }

    public function create() {

        if (isset($_POST['save'])) {
            $article = new Article();
            $article->setTitle($_POST['title']);
            $article->setContent($_POST['content']);
            $article->createArticle();

            View::redirectTo('');
        }
        View::render('article.create', []);
    }

    public function edit() {

        if (isset($_POST['save'])) {
            $article = new Article();
            $article->updateArticle($_GET['id'], $_POST['title'], $_POST['content']);

            View::redirectTo('');

        } else if (isset($_GET['id'])) {
            $article = new Article();
            $article = $article->getArticleById($_GET['id']);

            View::render('article.edit', ['article' => $article]);
        }
    }

    public function delete() {

        if (isset($_GET['id'])) {
            $article = new Article();
            $article->deleteArticle($_GET['id']);
        }
    }
}
