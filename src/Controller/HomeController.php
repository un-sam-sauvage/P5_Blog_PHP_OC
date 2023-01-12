<?php

namespace App\Controller;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class HomeController extends BaseController
{
	public function index()
	{
		$this->render('home/homepage.view.php');
	}

	public function sendMail () {
		if (isset($_POST["email"]) && isset($_POST["content"]) && isset($_POST["name"])) {
			$mail = new PHPMailer(true);

			$mail->IsSMTP(); // telling the class to use SMTP
			$mail->SMTPAuth = true; // enable SMTP authentication
			$mail->SMTPSecure = "ssl"; // sets the prefix to the servier
			$mail->Host = "smtp.gmail.com"; // sets GMAIL as the SMTP server
			$mail->Port = 465; // set the SMTP port for the GMAIL server
			$mail->Username = "samuel.brb19@gmail.com"; // GMAIL username
			$mail->Password = "labovatgygxbysey"; // GMAIL password
			
			//Typical mail data
			$mail->AddAddress("samuel.brb19@gmail.com", "Samuel");
			$mail->SetFrom($_POST["email"], $_POST["name"]);
			$mail->Subject = "New message from your blog";
			$mail->Body = $_POST["content"];
			
			try{
				$mail->Send();
				echo json_encode(array("typeMsg" => "msg-success", "msg" => "mail successfully sent"));
			} catch(Exception $e){
				//Something went bad
				echo json_encode(array("type-msg" => "msg-fail", "msg" => "error while sending mail ". $e->getMessage()));
			}
		} else {
			echo json_encode(array("error", "error in Post", "POST" => $_POST));
		}
		
	}
}
