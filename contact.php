<?php
	include_once("./includes/user_agent.php");
	//ID OF THE PAGE
	$pageid=4;
	require_once './includes/index.php';
	$page = new contact();
	if(isset($_POST['name'])){
		$name=$_POST['name'];
		$email=$_POST['email'];
		$msg=$_POST['message'];
		if(!$name || !$email || !$msg){
			//Error msg
		}
		else{
			//contact msg
			$page->message($name,$email,$msg);
		}
		unset($_POST['name']);
	}
?>
<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="theme-color" content="#191970">
		<link rel="shortcut icon" href="./images/favicon.png" type="image/x-icon">
		<title>APLUS TECH | CONTACT</title>
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="./css/bootstrap.css">
		<link rel="stylesheet" href="./css/style.css">
		<link rel="stylesheet" href="./css/font-awesome.css">
		<link rel="stylesheet" href="./css/animate.css">
		<meta property="og:site_name" content="APLUS TECH">
		<meta property="og:title" content="CONTACT" />
		<meta property="og:description" content="" />
		<meta property="author" content="Satheesh Kumar"/>
		<meta property="og:type" content="WEBSITE" />
	</head>
	<body>
		<?php include_once './includes/header.php'; ?>

		<div class="container-fluid" style="padding-top: 80px;background-color: rgba(255,255,255,0.4);">
			<div class="row">
				<h2 align="center" style="text-transform: uppercase;padding-bottom: 70px;"> We are glad to hear from you</h2>

				<div class="col-md-6" style="padding-bottom: 40px;">
					<?php
						session_start();
						if(isset($_SESSION['SERVER_INFO'])){
							$title_bar=$_SESSION['SERVER_INFO'];
							unset($_SESSION['SERVER_INFO']);
						}
						else{
							$title_bar="SEND APLUS TECH A MESSAGE";
						}
					?>
					<p class="lead" title="APLUS TOP ARTICLES"><?php echo $title_bar; ?></p>
					<hr align="left" class="bline "/>
					<form action="" method="POST" role="form">
					
						<div class="form-group">
							<label for="inputName">NAME</label>
							<input type="text" class="form-control" id="inputName" placeholder="Enter your name to contact us." name="name" required="">
						</div>
						<div class="form-group">
							<label for="inputEmail">EMAIL ADDRESS</label>
							<input type="email" class="form-control" id="inputEmail" placeholder="Enter your Email to contact us." name="email" required="">
						</div>
						<div class="form-group">
							<label for="inputMsg">Message</label>
							<textarea name="message" id="inputMsg" class="form-control" rows="6" required="required" placeholder="Enter the message to contact us......"></textarea>
						</div>
						<button type="submit" class="btn btn-primary btn-block"><i class="fa fa-envelope">&nbsp;&nbsp;</i>SEND MESSAGE</button>
					</form>
				</div>
				<div class="col-md-6" style="padding-bottom: 40px;">
					<p class="lead" title="APLUS TOP ARTICLES">CONTACT APLUS TECH</p>
					<hr align="left" class="bline "/>
					<div class="col-sm-6">
						<br>
						<div class="panel panel-default">
							<div class="panel-body">
								<h3>OFFICE:</h3>
								<hr>
								<address>
									APLUS INC,<br>
									206/1, Shanmuga Nagar,<br>
									Sanganoor Road,<br>
									Ratinapuri Post,<br>
									Coimbatore,<br>
									India,<br>
									641-027.
								</address>
							</div>
						</div>
						<a href="tel:09942760018"><button type="button" class="btn btn-warning btn-block"><i class="fa fa-phone">&nbsp;</i>CALL</button></a>
					</div>
					<div class="col-sm-6">
						<br>
						<div class="panel panel-default">
							<div class="panel-body">
								<h3>SITE ADMIN:</h3>
								<hr>
								<address>
									Satheesh Kumar D<br><br>
									satheesh.101097@gmail.com<br><br>
									Facebook: /satheesh1997<br><br>
									Twitter: /satheesh101097
								</address>
							</div>
						</div>
						<a href="tel:09597264229"><button type="button" class="btn btn-warning btn-block"><i class="fa fa-phone">&nbsp;</i>CALL</button>
						</a>
					</div>
				</div>
			</div>
		</div>

		<?php include_once("./includes/footer.php"); ?>
		<!-- jQuery -->
		<script src="./js/jquery-3.1.1.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="./js/bootstrap.js"></script>
		<script src="./js/wow.js"></script>
		<script>
            new WOW().init();
        </script>
	</body>
</html>