<?php
namespace App\Controller;

use App\Models\CommentModel;
use App\Models\UserModel;
use Exception;
use Symfony\Component\VarDumper\VarDumper;

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
					case "validate-comment":
						if(isset($_POST["id"]))
							echo $this->validateComment($_POST["id"]);
						else throw new Exception("no post id indicated");
						break;
					case "reject-comment":
						if(isset($_POST["id"]))
							echo $this->rejectComment($_POST["id"], $_POST["comment"]);
						else throw new Exception("no id indicated");
						break;
					case "edit-comment" :
						if(isset($_POST["id"]) && isset($_POST["content"]))
							echo $this->editComment($_POST["id"], $_POST["content"]);
						else throw new Exception("the content or id cannot be empty");
						break;
					case "delete-comment":
						if(isset($_POST["id"])) 
							echo $this->deleteComment($_POST["id"]);
						else throw new Exception("id cannot be empty");
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
			$this->error("Please connect before creating a post");
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

	private function validateComment (int $commentId) {
		$commentModel = new CommentModel();
		$commentModel->validateComment($commentId);
		return json_encode(array("typeMsg" => "msg-success", "msg" => "The comment has been validated successfully"));
	}

	private function rejectComment (int $commentId, string $comment) {
		$commentModel = new CommentModel();
		if(empty($comment)) {
			$comment = "";
		}
		$commentModel->rejectComment($commentId, $comment);
		return json_encode(array("typeMsg" => "msg-success", "msg" => "The comment has been rejected sucessfully"));
	}

	private function editComment ($commentId, $content) {
		$commentModel = new CommentModel();
		if (empty($content)) {
			return json_encode(array("typeMsg" => "msg-fail", "msg" => "The new comment cannot be empty"));
		}
		$commentModel->editComment($commentId, htmlspecialchars($content));
		return json_encode(array("typeMsg" => "msg-success", "msg" => "You comment has been sent to validation"));
	}

	private function deleteComment ($commentId) {
		$commentModel = new CommentModel();
		$commentModel->deleteComment($commentId);
		return json_encode(array("typeMsg" => "msg-success", "msg" => "your comments has been deleted"));
	}

	public function getCommentsToValidate () {
		$commentModel = new CommentModel();
		$userModel = new UserModel();
		if (isset($_SESSION["user_id"])) {
			if ($userModel->isAdmin($_SESSION["user_id"])) {
				$comments = $commentModel->getCommentsToValidate();
				$this->render("home/adminPage.view.php", array("title" => "Validate comments", "comments" => $comments));
			} else {
				$this->error("You don't have enough right to access this page");
			}
		} else {
			$this->error("Please connect before accessing this page");
		}
	}
}