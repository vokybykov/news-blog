<?php

namespace App\Models;

use App\Core\Database;
use PDO;


class Article {
    private $connection;
    private $table = 'articles';

    private $id;
    private $title;
    private $content;

    public function __construct() {
        $this->connection = Database::connect();
    }

    public function getId() {
        return $this->id;
    }
    public function setId($id) {
        $this->id = $id;
    }

    public function getTitle() {
        return $this->title;
    }
    public function setTitle($title) {
        $this->title = $title;
    }

    public function getContent() {
        return $this->content;
    }
    public function setContent($content) {
        $this->content = $content;
    }

    public function getAllArticles() {
        $stmt = $this->connection->prepare("SELECT * FROM $this->table");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getArticlesWithPagination($from) {
        $stmt = $this->connection->prepare("SELECT * FROM $this->table LIMIT ? , 10");
        $stmt->bindValue(1, $from, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getArticleById($id) {
        $this->connection->setAttribute( PDO::ATTR_EMULATE_PREPARES, false );
        $stmt = $this->connection->prepare("SELECT * FROM $this->table WHERE id = ?");
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function createArticle() {
        $stmt = $this->connection->prepare("INSERT INTO $this->table (title, content) VALUES (:title, :content)");
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':content', $this->content);
        return $stmt->execute();
    }

    public function updateArticle($id, $title, $content) {
        $stmt = $this->connection->prepare("UPDATE $this->table  SET title = :title, content = :content WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);
        return $stmt->execute();
    }

    public function deleteArticle($id) {
        $stmt = $this->connection->prepare("DELETE FROM $this->table WHERE id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
