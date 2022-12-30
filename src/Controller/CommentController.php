<?php
namespace App\Controller;

use App\Models\CommentModel;
use Exception;

class CommentController extends BaseController {

	public function ajaxComment () {
		try {
			if(isset($_POST["route"])) {
				switch ($_POST["route"]) {
					case "get-post-comments" : 
						if(isset($_POST["postId"]))
							echo $this->getPostComments($_POST["postId"]);
						else throw new Exception("No post id given can't retrieve comments");
						break;
					case "create-comment":
						if(isset($_POST["postId"]) && isset($_SESSION["user_id"]) && isset($_POST["content"])) 
							echo $this->createComment($_POST["content"], $_POST["postId"], $_SESSION["user_id"]);
						else throw new Exception("There is an error in parameter. If POST is good then check if user_id is good too " . $_SESSION["user_id"]);
						break;
					default :
						throw new Exception("the route indicated doesn't exist");
				}
			} else {
				throw new Exception("No route indicated");
			}
		} catch (Exception $e) {
			echo json_encode(array("error" => $e->getMessage(), "POST" => $_POST));
		}
	}


	private function createComment (string $content, int $postId, int $userId) {
		$commentModel = new CommentModel();
		if (!isset($_SESSION["user_id"])) {
			$this->error("Merci de vous connecter afin de créer un post");
		}
		$commentModel->createComment(htmlspecialchars($content), $postId, $userId);
		return json_encode(array("success" => true));
	}

	private function getPostComments (int $postId) {
		$commentModel = new CommentModel();
		$comments = $commentModel->getPostComment($postId);
		if (empty($comments)) return json_encode(array("msg" => "no comments"));
		return json_encode(array("comments" => $comments));
	}
}