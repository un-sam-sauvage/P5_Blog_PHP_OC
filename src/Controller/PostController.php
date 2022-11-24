<?php
namespace App\Controller;

use App\Models\PostModel;

class PostController extends BaseController {
	
	public function showAllPost () {
		$postModel = new PostModel();
		$allPost = $postModel->getAllPost();
		var_dump($allPost);
		$this->render("posts/allPost.view.php",array("posts" => $allPost, "title" => "allPost"));
	}

	public function showSinglePost (int $id) {
		$postModel = new PostModel();
		$post = $postModel->getPost($id);
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
}