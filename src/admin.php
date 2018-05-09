<?php
session_start();
if( isset($_SESSION['admin_id']) ){
	header("Location:");
}
require 'database.php';
if(!empty($_POST['admin_id']) && !empty($_POST['password'])):
	
	$records = $conn->prepare('SELECT admin_id FROM Admin WHERE admin_id = :admin_id AND password = :password');
	$records->bindParam(':admin_id', $_POST['admin_id']);
	$records->bindParam(':password', $_POST['password']);
	$records->execute();
	$results = $records->fetch(PDO::FETCH_ASSOC);
	$message = '';
	if(count($results) > 0 && $_POST['admin_id'] == $results['admin_id']){
		$_SESSION['admin_id'] = $results['admin_id'];
		header("Location: ./admin_market.php");
	} else {
		$message = 'Wrong username or password!';
	}
endif;
?>

<!DOCTYPE html>
<html>
<head>
	<title>Admin Login</title>
	
	<meta name="theme-color" content="#000000">
	<link rel="icon" sizes="48x48" href="https://mertdy.com/en/images/favicon-48x48.png">
	<link rel="icon" sizes="192x192" href="https://mertdy.com/en/images/favicon-192x192.png">
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="stylesheet" href="https://mertdy.com/en/assets/css/main.css">

	<style>
	/* Popup container */
	.popup {
		position: relative;
		display: inline-block;
		cursor: pointer;
		-webkit-user-select: none;
		-moz-user-select: none;
		-ms-user-select: none;
		user-select: none;
	}
	/* The actual popup */
	.popup .popuptext {
		visibility: hidden;
		width: 160px;
		background-color: #555;
		color: #fff;
		text-align: center;
		border-radius: 6px;
		padding: 8px 0;
		position: absolute;
		z-index: 1;
		bottom: 125%;
		left: 50%;
		margin-left: -80px;
	}
	/* Popup arrow */
	.popup .popuptext::after {
		content: "";
		position: absolute;
		top: 100%;
		left: 50%;
		margin-left: -5px;
		border-width: 5px;
		border-style: solid;
		border-color: #555 transparent transparent transparent;
	}
	/* Toggle this class - hide and show the popup */
	.popup .show {
		visibility: visible;
		-webkit-animation: fadeIn 1s;
		animation: fadeIn 1s;
	}
	/* Add animation (fade in the popup) */
	@-webkit-keyframes fadeIn {
		from {opacity: 0;} 
		to {opacity: 1;}
	}
	@keyframes fadeIn {
		from {opacity: 0;}
		to {opacity:1 ;}
	}
	</style>
</head>
<body>

	<header id="header" class="alt">
		<div id="logo" class="logo"><a href="./"><span>Web</span> App</a></div>
		<a href="#menu">Menu</a>
	</header>

	<nav id="menu">
		<ul class="links">
			<li><a href="./">Homepage</a></li>
		</ul>

		<footer id="footer">
			<ul class="icons">
				<li><a href="https://mertdy.com" class="icon fa-globe" style="font-size:20px"><span class="label">MertDy</span> MertDy</a></li>
			</ul>
			<div class="copyright">
				Mert Dönmezyürek &copy; 2018.
			</div>
		</footer>
	</nav>


	<section id="two" class="wrapper style3">
		<div class="inner">
			<header class="align-center">
				<p>Hello</p>
				<h2>Admin Login</h2>
			</header>
		</div>
	</section>

	<section id="information" class="wrapper style2">
		<div class="inner">
			<div class="box">
				<div class="content">
					<footer class="align-center">
						<form action="admin.php" method="POST" onsubmit="return validateForm()">

							<b>User Name</b>
							<br>
							<div class="popup">
								<input type="text" placeholder="Name" name="admin_id">
								<span class="popuptext" id="username_popup">Username needed!</span>
							</div>
							
							<br><br>
                            <b>Password</b>
							<br>
							<div class="popup">
								<input type="password" placeholder="Password" name="password">
								<span class="popuptext" id="password_popup">Password needed!</span>
							</div>
							
							<br><br>
<?php if(!empty($message)): ?>
<p><?= $message ?></p>
<?php endif; ?>
							<input type="submit" class="login_button" value="Login" name="submit">

						</form>
					</footer>
				</div>
			</div>
		</div>
	</section>

	<footer id="footer">
		<div class="copyright">
			<i style="font-size:10px">designed by</i> Mert Dönmezyürek &copy; 2018.
		</div>
	</footer>

	
	<!-- Scripts -->
	<script src="https://mertdy.com/en/assets/js/jquery.min.js"></script>
	<script src="https://mertdy.com/en/assets/js/jquery.scrollex.min.js"></script>
	<script src="https://mertdy.com/en/assets/js/skel.min.js"></script>
	<script src="https://mertdy.com/en/assets/js/util.js"></script>
	<script src="https://mertdy.com/en/assets/js/main.js"></script>

	
	<script>
	// When the user clicks on div, open the popup
	function validateForm() {
		if (!$("input[type='text'][name='admin_id']").val())
		{
			var popup = document.getElementById("username_popup");
			popup.classList.toggle("show");
			return false;
		}
		else if (!$("input[type='password'][name='password']").val())
		{
			var popup = document.getElementById("password_popup");
			popup.classList.toggle("show");
			return false;
		}
		
	}
	</script>

</body>
</html>