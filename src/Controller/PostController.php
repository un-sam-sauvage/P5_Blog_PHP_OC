<?php
namespace App\Controller;

use App\Models\PostModel;

class PostController extends BaseController {
	
	public function showAllPost () {
		$postModel = new PostModel();
		$allPost = $postModel->getAllPost();
		$this->render("posts/allPost.view.php",array("posts" => $allPost, "title" => "allPost"));
	}

	public function showSinglePost (int $id) {
		$postModel = new PostModel();
		$post = $postModel->getPost($id, $_SESSION["user_id"]);
		$isAuthor = $postModel->isAuthor($post["id"],$_SESSION["user_id"]);
		$this->render("posts/singlePost.view.php", array("post" => $post, "title" => $post["title"], "isAuthor" => $isAuthor));
	}

	public function renderCreatePost () {
		$this->render("posts/createPost.view.php", array("title" => "Create your post"));
	}

	public function createPost () {
		$postModel = new PostModel();
		if($_SESSION["user_id"]) {
			$postModel->createPost($_SESSION["user_id"],$_POST["title"],$_POST["content"]);
		} else {
			$this->error("L'id de l'utilisateur n'est pas défini");
		}
		$allPost = $postModel->getAllPost();
		$this->render("posts/allPost.view.php", array("posts" => $allPost, "title" =>"allPost"));
	}
	public function ajaxPost () {
		if(isset($_POST["route"])) {
			if($_POST["route"] == "deletePost" && isset($_POST["postID"])) {
				echo deletePost($_POST["postID"]);
			} else if ($_POST["route"] == "updatePost" && isset($_POST["postID"]) && isset($_POST["content"]) && isset($_POST["title"])){
				echo updatePost($_POST["postID"], $_POST["content"], $_POST["title"]);
			} else {
				echo json_encode(array("error" => "error in POST or wrong route indicated", "POST" => $_POST));
			}
		} else {
			echo json_encode(array("error" => "no route indicated"));
		}
	}

	private function deletePost (int $postId) {
		$postModel = new PostModel();
		$postModel->deletePost($postId);
		return json_encode(array("success" => "post has been successfully deleted"));
	}

	private function updatePost (int $postId, string $content, string $title) {
		$postModel = new PostModel();
		$postModel->updatePost($postId, $title, $content);
		return json_encode(array("success" => "post has been successfully updated"));
	}
}