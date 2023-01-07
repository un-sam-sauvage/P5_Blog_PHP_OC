<?php

namespace App\Models;

class CommentModel {
	private $db;

	public function __construct()
	{
		$this->db = new DB();
	}

	public function getPostComment (int $postId) {
		return $this->db->select(
			"SELECT users.username, comments.content, comments.created_at, comments.updated_at
			FROM comments 
			JOIN users ON users.id = comments.authorId
			WHERE comments.isAuthorized = 1
			AND postId = ?"
			, array($postId), "i");
	}

	public function createComment (string $content, int $postId, int $userId) {
		$this->db->query(
			"INSERT INTO comments 
			(content, postId, authorId, isAuthorized)
			VALUES (?, ?, ?, 0)",
			array($content, $postId, $userId), "ssi"
		);
	}

	public function deleteComment (int $commentId) {
		$this->db->query("DELETE FROM comments WHERE id = ?", array($commentId), "i");
	}

	public function editComment (int $commentId, string $content) {
		$this->db->query("UPDATE comments SET content = ?, updated_at = CURRENT_TIMESTAMP, isAuthorized = 0, rejectionComment = '' WHERE id = ?", array($content, $commentId), "si");
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

	public function getCommentsToValidate () {
		return $this->db->selectWithoutPreparation(
			"SELECT comments.id as id, content, postId, users.username as username
			FROM comments 
			JOIN users ON comments.authorId = users.id 
			WHERE isAuthorized = 0
			AND (rejectionComment IS NULL OR rejectionComment = '')
		");
	}

	public function validateComment ($commentId) {
		$this->db->query("UPDATE comments SET isAuthorized = 1, rejectionComment = '' WHERE id = ?", array($commentId), "i");
	}

	public function rejectComment (int $commentId, string $comment) {
		$this->db->query("UPDATE comments SET isAuthorized = 0, rejectionComment = ? WHERE id = ?", array($comment, $commentId), "si");
	}

	public function getUserComments ($userId) {
		return $this->db->select("SELECT * FROM comments WHERE authorId = ?", array($userId), "i");
	}
}