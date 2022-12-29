<?php

namespace App\Models;

class CommentModel {
	private $db;

	public function __construct()
	{
		$this->db = new DB();
	}

	public function getPostComment (int $postId) {
		$this->db->select(
			"SELECT users.username, comments.content, comments.created_at, comments.updated_at
			FROM comments 
			JOIN users ON users.id = comments.authorId
			WHERE comments.isAuthorized = 1
			AND postId = ?"
			, array($postId), "i");
	}

	public function createComment ( string $content, int $postId, int $userId) {
		$this->db->query(
			"INSERT INTO comments 
			(content = ?, postId = ?, userId = ?, isAuthorized = 0)",
			array($content, $postId, $userId), "ssi"
		);
	}

	public function deleteComment (int $commentId) {
		$this->db->query("DELETE FROM comments WHERE id = ?", array($commentId), "i");
	}

	public function editComment (int $commentId, string $content) {
		$this->db->query("UPDATE comments SET content = ? WHERE id = ?", array($content, $commentId), "si");
	}

	public function getCommentAnswer (int $commentId) {
		$this->db->select(
		"SELECT users.username, comments.content, comments.created_at, comments.updated_at
		FROM comments 
		JOIN users ON users.id = comments.authorId
		WHERE comments.isAuthorized = 1
		AND comments.id = ?"
		, array($commentId), "i");
	}
}