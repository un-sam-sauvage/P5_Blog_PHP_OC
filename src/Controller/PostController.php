<?php
namespace App\Controller;

use App\Models\CommentModel;
use App\Models\PostModel;
use Exception;

class PostController extends BaseController {
	
	public function showAllPost () {
		$postModel = new PostModel();
		$allPost = $postModel->getAllPost();
		$this->render("posts/allPost.view.php",array("posts" => $allPost, "title" => "allPost"));
	}

	public function showSinglePost (int $id) {
		$postModel = new PostModel();
		$commentModel = new CommentModel();
		$userId = isset($_SESSION["user_id"]) ? $_SESSION["user_id"] : -1;
		$post = $postModel->getPost($id, $userId);
		$isAuthor = $postModel->isAuthor($post["id"],$userId);
		$comments = $commentModel->getPostComment($id);
		dump($comments);
		$this->render("posts/singlePost.view.php", array("post" => $post, "title" => $post["title"], "isAuthor" => $isAuthor, "comments" => $comments));
	}

	public function renderCreatePost () {
		$this->render("posts/createPost.view.php", array("title" => "Create your post"));
	}

	public function createPost () {
		$postModel = new PostModel();
		if($_SESSION["user_id"]) {
			$postModel->createPost($_SESSION["user_id"],htmlspecialchars($_POST["title"]),htmlspecialchars($_POST["content"]));
		} else {
			$this->error("L'id de l'utilisateur n'est pas défini");
		}
		$allPost = $postModel->getAllPost();
		$this->render("posts/allPost.view.php", array("posts" => $allPost, "title" =>"allPost"));
	}
	public function ajaxPost () {
		try {
			if(isset($_POST["route"])) {
				switch ($_POST["route"]) {
					case "deletePost" :
						if(isset($_POST["postID"]))
						echo $this->deletePost($_POST["postID"]);
						else throw new Exception("No postId");
						break;
					case "updatePost" :
						if (isset($_POST["postID"]) && isset($_POST["content"]) && isset($_POST["title"]))
							echo $this->updatePost($_POST["postID"], $_POST["content"], $_POST["title"]);
						else throw new Exception("No postID or content or title");
						break;
					default:
						throw new Exception("wrong route indicated");
				}
			} else {
				throw new Exception("No route indicated");
			}
		}catch (Exception $e) {
			echo json_encode(array("error" => $e->getMessage(), "POST" => $_POST));
		}
	}

	private function deletePost (int $postId) {
		$postModel = new PostModel();
		$postModel->deletePost($postId);
		return json_encode(array("success" => "post has been successfully deleted"));
	}

	private function updatePost (int $postId, string $content, string $title) {
		$postModel = new PostModel();
		$postModel->updatePost(htmlspecialchars($postId), htmlspecialchars($title), htmlspecialchars($content));
		return json_encode(array("success" => "post has been successfully updated"));
	}
}