<?php

namespace App\Models;

class CommentModel {
	private $db;

	public function __construct()
	{
		$this->db = new DB();
	}

	public function getPostComment (int $postId) {

	}

	public function createComment (string $title, string $content, int $postId, int $userId) {

	}

	public function deleteComment (int $commentId) {

	}

	public function editComment (int $commentId, int $userId) {

	}

	public function getCommentAnswer (int $commentId) {
		
	}
}