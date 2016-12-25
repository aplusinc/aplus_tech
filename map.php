<?php
	include_once("./includes/user_agent.php");
	//ID OF THE PAGE
	$pageid=3;
?>
<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="theme-color" content="#191970">
		<link rel="shortcut icon" href="./images/favicon.png" type="image/x-icon">
		<title>APLUS TECH | MAP</title>
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="./css/bootstrap.css">
		<link rel="stylesheet" href="./css/style.css">
		<link rel="stylesheet" href="./css/font-awesome.css">
		<link rel="stylesheet" href="./css/animate.css">
	</head>
	<body>
		<?php include_once './includes/header.php'; ?>

		<div class="container-fluid" style="padding-top: 80px;background-color: rgba(255,255,255,0.4);">
			<div class="row">
				<div class="col-lg-3"></div>
				<div class="col-lg-6" style="padding-top: 90px;padding-bottom: 90px;">
					<div class="alert alert-warning text-center">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h1>OOPS!</h1>
						<br><br>
						<h3> THIS PAGE IS STILL UNDER DEVELOPMENT</h3>
						<br><br>
						<br><br>
						<p class="text-right">-APLUS INC</p>
					</div>
				</div>
				<div class="col-lg-3"></div>
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