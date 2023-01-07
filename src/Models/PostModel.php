<?php

namespace App\Models;

class PostModel {
	private $db;

	public function __construct () {
		$this->db = new DB();
	}

	public function getAllPost () {
		return $this->db->selectWithoutPreparation(
			"SELECT posts.id, posts.content, posts.title, users.username, posts.created_at
			FROM posts 
			JOIN users ON users.id=posts.author"
		);
	}

	public function getPost (int $id) {
		return $this->db->selectSingle(
			"SELECT posts.id, posts.content, posts.title, users.username, posts.created_at, posts.updated_at
			FROM posts 
			JOIN users ON users.id=posts.author 
			WHERE posts.id = ?"
		, array($id), "i");
	}
	public function isAuthor (int $postId, int $userId) {
		$isAuthor = $this->db->select("SELECT * FROM posts WHERE id = ? AND author = ?", array($postId, $userId), "ii");
		if(!empty($isAuthor))
			return true;
		return false;
	}
	public function createPost (int $author,string $title, string $content) {
		$this->db->query("INSERT INTO posts (title, content, author) VALUES (?, ?, ?)", array($title, $content, $author), "ssi");
	}

	public function updatePost (int $id, string $title, string $content) {
		$this->db->query("UPDATE posts SET title = ?, content = ? WHERE id = ?", array($title, $content, $id), "ssi");
	}

	public function deletePost (int $id){
		$this->db->query("DELETE FROM posts WHERE id = ?", array($id), "i");
	}
}
