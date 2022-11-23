<?php

namespace App\Models;

class PostModel {
	private $db;

	public function __construct () {
		$this->db = new DB();
	}

	public function getAllPost () {
		return $this->db->select("SELECT * FROM posts");
	}

	public function getPost (int $id) {
		return $this->db->select("SELECT * FROM posts WHERE id = ".$id);
	}

	public function createPost (int $author,string $title, string $content) {
		$this->db->query("INSERT INTO posts (title, content, author) VALUES ('".$title."', '".$content."', ".$author.")");
	}

	public function updatePost (int $id, string $title, string $content) {
		$this->db->query("UPDATE posts SET title = '".$title."', content = '".$content."' WHERE id = ".$id);
	}

	public function deletePost (int $id){
		$this->db->query("DELETE FROM posts WHERE id = ".$id);
	}
}
