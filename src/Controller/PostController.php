<?php
namespace App\Controller;

use App\Models\PostModel;

class PostController extends BaseController {
	
	public function showAllPost () {
		$postModel = new PostModel();
		$allPost = $postModel->getAllPost();
		$this->render("posts/allPost.view.php",array("posts" => $allPost));
	}
}