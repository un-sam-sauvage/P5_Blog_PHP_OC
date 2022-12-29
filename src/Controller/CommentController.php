<?php
namespace App\Controller;

use App\Models\CommentModel;
use Exception;

class CommentController extends BaseController {
	public function createComment () {
		$commentModel = new CommentModel();
		if (!isset($_SESSION["user_id"])) {
			$this->error("Merci de vous connecter afin de créer un post");
		}
		try {
			$commentModel->createComment(htmlspecialchars($_POST["content"]), $_POST["postId"], $_SESSION["user_id"]);
		} catch (Exception $e) {
			return json_encode(array("error" => $e->getMessage()));
		} 
		return json_encode(array("success" => true));
	}

	public function getPostComments () {
		$commentModel = new CommentModel();
		$comments = $commentModel->getPostComment($_POST["postId"]);
		return json_encode(array("comments" => $comments));
	}
}