<?php
	include_once("./includes/user_agent.php");
	//ID OF THE PAGE
	$pageid=6;
	include_once './includes/index.php';
	$post=new post();
	$manage=new manage();
	$server=new server();
	
?>
<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="theme-color" content="#191970">
		<link rel="shortcut icon" href="./images/favicon.png" type="image/x-icon">
		<title>APLUS TECH | MANAGE</title>
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="./css/bootstrap.css">
		<link rel="stylesheet" href="./css/style.css">
		<link rel="stylesheet" href="./css/font-awesome.css">
		<link rel="stylesheet" href="./css/animate.css">
		<link rel="stylesheet" href="./css/summernote.css">
	</head>
	<body>
		<?php include_once './includes/header.php'; ?>

		<?php
			session_start();
			if(!isset($_SESSION['SID'])){
				if($_GET['task'] != "register"){
					include("./includes/auth.php");
				}
				else{
					include("./includes/register.php");
				}
			}
			else{
				if(isset($_GET['task'])){
					if($_GET['task'] == "post"){
						include("./includes/post.php");
					}
					if($_GET['task'] == "logout"){
						unset($_SESSION['SID']);
						session_destroy();
						header("location:./manage.php");
					}	
				}
				else{
					include("./includes/manage.php");
				}
			}


		?>

		<?php include_once("./includes/footer.php"); ?>
		<!-- jQuery -->
		<script src="./js/jquery-3.1.1.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="./js/bootstrap.js"></script>
		<script src="./js/summernote.js"></script>
		<script src="./js/validator.js"></script>
		<script src="./js/wow.js"></script>
		<script>
            new WOW().init();
        </script>
        <script type="text/javascript">
    		$('#summernote').summernote({
    			 height: 250,                 // set editor height
				 minHeight: null,             // set minimum height of editor
				 maxHeight: null,             // set maximum height of editor
				 focus: true 
    		});
        </script>
	</body>
</html>