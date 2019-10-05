<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Models\Article;
use App\Core\View;

class ArticleController extends Controller {

    public function index() {
        $article = new Article();
        $articles = $article->getAllArticles();

        View::render('article.list', ['articles' => $articles]);
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
}

