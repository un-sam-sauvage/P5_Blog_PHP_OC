<link href="/styles/homepage.css" rel="stylesheet">
<style>
	#socials {
		font-size: 4vw;
	}
	.my-tooltip {
		position: relative;
	}
	.my-tooltip:hover::before {
		content : attr(data-tooltip);
		width: 200%;
		padding: 5%;
		border-radius: 52px;
		left: -50%;
		height: fit-content;
		font-size: .8vw;
		position: absolute;
		top: -25%;
		text-decoration: none;
		color: white;
		background-color: darkgray;
	}
	#bottom-row {
		gap:100px;
		text-align: center;
	}
</style>
<div class="container" style="padding-top:2%;">
	<div class="row">
		<div class="col-8">
			<h1 aria-describedby="title-description" class="col-8" id="title">Samuel Barbeau's blog</h1>
			<p id="title-description" class="form-text">You don't know it yet but you need me !</p>
			<div class="row">
				<a href="/posts" class="col-6 btn btn-primary">See all posts</a>
				<a href="/profile" aria-describedby="register" class="col-6 btn btn-secondary">Login</a>
			</div>
			<small id="register"><a href="/register">If you don't have an account click here</a></small>
		</div>
		<img class="col-4" id="profile-picture" src="/pictures/profilePicture.png" alt="profile-picture">
	</div>
	<div class="row" id="bottom-row" style="padding-top: 2%">
		<div class="col-6" id="socials">
			<h5>Contact me somewhere else</h5>
			<a href="https://github.com/un-sam-sauvage"><i class="fa-brands fa-github"></i></a>
			<a href="mailto:samuel.brb19@gmail.com"><i class="fa-solid fa-envelope"></i></a>
			<a href="tel:06-71-79-37-35"><i class="fa-solid fa-phone"></i></a>
			<a data-tooltip="Click to copy : #6167" class="my-tooltip" id="discord-copy"><i class="fa-brands fa-discord"></i></a>
			<a href="/file/CV_Samuel_Barbeau.pdf" data-tooltip="Download my cv" class="my-tooltip"download="/file/CV_Samuel_Barbeau.pdf"><i class="fa-solid fa-file-pdf"></i></a>
			<input id="copy-text"style="display:none;" value="#6167"></input>
		</div>
		<div class="col-4">
			<h5>If you have any question feel free to contact me</h5>
			<input type="text" class="form-control" id="name" placeholder="Enter your name">
			<input  type="email" class="form-control" id="email" placeholder="Enter your email adress">
			<textarea class="form-control" id="content" cols="30" rows="10" placeholder="Enter the message you want to send"></textarea>
			<button class="btn btn-success" id="submit-mail">Send your message</button>
		</div>
	</div>
</div>

<script type="module">
	import {fct_fetchData} from "/js/mod_ajax.js";

	document.getElementById("discord-copy").addEventListener("click", () => {
		// Get the text field
		var copyText = document.getElementById("copy-text");

		// Select the text field
		copyText.select();
		copyText.setSelectionRange(0, 99999); // For mobile devices

		// Copy the text inside the text field
		navigator.clipboard.writeText(copyText.value);
	})

	document.getElementById("submit-mail").addEventListener("click", btn => {
		btn.preventDefault();
		let name = document.getElementById("name").value;
		let email = document.getElementById("email").value;
		let content = document.getElementById("content").value;
		let msg = ""
		if (name.length == 0) {
			msg += "Please enter your name <br />";
		}
		if (email.length == 0) {
			msg += "Please enter your email adress <br />";
		}
		if (content.length == 0) {
			msg += "Please fill the content of the message";
		}
		console.log(msg);
		if(msg.length > 0) {
			fct_setAlerte(msg, "msg-warning");
		} else {
			fct_fetchData("send-mail", {
				name : name,
				email : email,
				content : content
			}).then (data => {
				console.log(data);
				if (data.typeMsg == "msg-success") {
					document.getElementById("name").value = "";
					document.getElementById("email").value = "";
					document.getElementById("content").value = "";
				}
				fct_setAlerte(data.msg, data.typeMsg)
			})
		}
	})
</script>