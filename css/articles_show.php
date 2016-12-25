<?php
	include_once("./includes/user_agent.php");
	$pageid=0;
	include_once './includes/index.php';
	session_start();
	$article=new post();
	if(isset($_SESSION['SID'])){
		$isloggedin=1;
	}
	if($_SESSION['viewed'] != $_GET['id']){
		$viewed=$article->add_view($_GET['id']);
		$_SESSION['viewed']=$_GET['id'];
	}
	$post=$article->get_article($_GET['id']);
	if(count($post) < 1){
		echo "THE REQUESTED POST IS NOT FOUND ON SERVER";
		exit();
	}
	$ttime=date('G:i A',$post['post_timestamp']);
	$tdate=date('d-m-y',$post['post_timestamp']);
	$comments=$article->comments($_GET['id']);
	$total_comments=count($comments);
	if($_GET['action'] == "unlike"){
		if($_COOKIE['UNLIKED'] != $_GET['id']){
			$likeinfo=$article->unlike($_GET['id']);
			setcookie("UNLIKED",$_GET['id'],0);
		}
	}
	if($_GET['action'] == "like"){
		if($_COOKIE['LIKED'] != $_GET['id']){
			$likeinfo=$article->like($_GET['id']);
			setcookie("LIKED",$_GET['id'],0);
		}
	}
	if($_POST['comment']){
		if($_POST['comment'] != "" || $_POST['comment'] != null){
			$add_comment=$article->add_comment($_SESSION['SID'],$_GET['id'],$_POST['comment']);
			$cmt_info=$add_comment;
			header("location:./articles_show.php?id=".$_GET['id']."#comment");
		}
		else{
			$cmt_info="Fill The Comments Box";
		}
	}
	$index=new index();
	$trend=$index->trends();
	if(!isset($_COOKIE['APLUS_TECH_ID'])){
		$rand=rand();
		$server->add_ip($_SERVER['REMOTE_ADDR'],$rand);
		if($server)
			setcookie('APLUS_TECH_ID',$rand,time()+3600*67*65);
	}
	$protocol = $_SERVER['SERVER_PROTOCOL'];
    $domain     = $_SERVER['HTTP_HOST'];
    $script   = $_SERVER['SCRIPT_NAME'];
    $parameters   = $_SERVER['QUERY_STRING'];
	//next we do a bit of string manipulation to convert output like HTTP/1.1 to http
    $protocol=strpos(strtolower($_SERVER['SERVER_PROTOCOL']),'https') 
                === FALSE ? 'http' : 'https';
 
	//now the final part to concatenate all this together to form the URL
    $FinalUrl = $protocol . '://' . $domain. $script . '?' . $parameters;
	
?>
<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="theme-color" content="#191970">
		<link rel="shortcut icon" href="./images/favicon.png" type="image/x-icon">
		<title title="<?php echo $post['post_heading']; ?>"><?php echo $post['post_heading']; ?></title>
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="./css/bootstrap.css">
		<link rel="stylesheet" href="./css/style.css">
		<link rel="stylesheet" href="./css/font-awesome.css">
		<link rel="stylesheet" href="./css/animate.css">
		<meta property="og:url" content="<?php echo $FinalUrl; ?>">
		<meta property="og:title" content="<?php echo $post['post_heading']; ?>" />
		<meta property="og:description" content="<?php echo strip_tags(substr($post['post_content'],0,400))."......"; ?>" />
		<meta property="author" content="<?php echo $post['user_name']; ?>"/>
		<meta property="og:type" content="article" />
		<meta property="og:image" content="<?php echo $post['post_main_image']; ?>">
	</head>
	<body style="">
		<?php include_once './includes/header.php'; ?>
		<div class="container wow fadeInDown" style="padding-top: 80px;min-height: 700px;background-color: white;box-shadow: 2px 1px 1px 2px grey;">

			<div class="row">
				<div class="col-lg-12" >
					<div class="panel panel-default" style="background-color: rgba(255,255,255,0);border:0px solid white;">
						<div class="panel-body" style="background-color: rgba(255,255,255,1);padding: 0px;padding-right: 25px;padding-left: 25px">
							<h2 style="text-transform: capitalize;letter-spacing: 1px;word-spacing: 3px;" class="wow fadeInLeft" data-wow-delay=".7s"><?php echo $post['post_heading']; ?></h2>
							<hr align="left" class="bline wow fadeInLeft" data-wow-delay=".8s">
							<p class="details wow fadeInLeft" data-wow-delay=".9s"><i class="fa fa-user">&nbsp;</i><a class="link_name" href="./user.php?id=<?php echo $post['post_user']; ?>"><?php echo $post['user_name'];?></a>&nbsp;&nbsp;&nbsp;<i class="fa fa-calendar">&nbsp;</i><?php echo $tdate;?>&nbsp;&nbsp;&nbsp;<i class="fa fa-clock-o">&nbsp;</i><?php echo $ttime;?>&nbsp;&nbsp;&nbsp;<i class="fa fa-eye">&nbsp;</i><?php echo $post['post_views'];?>
							&nbsp;&nbsp;&nbsp;<i class="fa fa-thumbs-up">&nbsp;</i><?php echo $post['post_likes'];?>&nbsp;&nbsp;&nbsp;<i class="fa fa-thumbs-down">&nbsp;</i><?php echo $post['post_dislikes'];?>
							</p>

							<div class="posted" style="font-size:20px;margin-top: 40px;line-height: 25px;word-spacing: 2px;font-family: jose;">
								<?php echo stripslashes($post['post_content']); ?>
								<div class="panel panel-info wow fadeInRight" data-wow-delay="1s" id="like">
									<div class="panel-body">
										<p>WAS THIS POST USEFULL&nbsp;&nbsp;&nbsp;
										<a href="./articles_show.php?id=<?php echo $post['post_id'];?>&action=like">
										<button type="button" class="btn btn-sm btn-success">YES</button>
										</a>
										<a href="./articles_show.php?id=<?php echo $post['post_id'];?>&action=unlike">
										<button type="button" class="btn btn-sm btn-danger">NO</button>
										</a>
										<?php echo $likeinfo; ?>
										</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row" style="padding:25px;background-color: lavender;">
				<div class="col-sm-5" id="comment">
					<p class="lead" title="<?php echo $post['post_heading']; ?> COMMENTS"><i class="fa fa-comments">&nbsp;</i>COMMENTS&nbsp;<sup><span class="badge" style="background-color: red"><?php echo $total_comments; ?></span></sup></p>
					<hr align="left" class="cline wow fadeInLeft" data-wow-delay="2s"/>
					<br>
					<?php if($isloggedin == 1){?>
					<form action="./articles_show.php?id=<?php echo $post['post_id'];?>" method="POST">
					<textarea name="comment" id="input" class="form-control" rows="3" required="required"></textarea>
					<br>
					<p class="text-right">
					<button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-comment">&nbsp;</i>COMMENT</button>
					</p>
					</form>
					<?php } 
					else{?>
						<p class="text-right">
						<a href="./manage.php" target="_blank"><button type="button" class="btn btn-sm btn-primary"><i class="fa fa-sign-in">&nbsp;</i>LOGIN TO COMMENT</button></a>
						</p>
					<?php } ?>
					<br>
						<?php echo $cmt_info; ?>
					<br>
					<div class="flexcroll">
					<?php
					$i=0;
					while($i < $total_comments){ ?>
						<div class="panel panel-default wow fadeInLeft" data-wow-delay="<?php echo "0.".($i+2)."s";?>">
							<div class="panel-body" style="padding: 5px;">
								<div class="media">
									<a class="pull-left" href="./user.php?id=<?php echo $comments[$i]['user_id'];?>">
										<img class="media-object" src="<?php echo $comments[$i]['user_dp'];?>" alt="Image" width="50px;">
									</a>
									<div class="media-body">
										<h4 class="media-heading"><a href="./user.php?id=<?php echo $comments[$i]['user_id'];?>"><?php echo $comments[$i]['user_name'];?></a></h4>
										<p><?php echo $comments[$i]['comment'];?></p>
									</div>
								</div>
							</div>
						</div>
					<?php $i++; } ?>
					</div>
				</div>
				<div class="col-sm-2"></div>
				<div class="col-sm-5" id="comment">
					<p class="lead">TRENDING POSTS&nbsp;</p>
					<hr align="left" class="cline wow fadeInLeft" data-wow-delay="2s"/>
					<br>
					<div class="row">
						<div class="col-sm-5" style="padding: 0px;">
							<div class="panel panel-default wow fadeInUp">
								<div class="panel-body" style="padding: 0px;">
									<img src="<?php echo $trend[2]['post_main_image'];?>" class="img-responsive"/>
									<a href="./articles_show.php?id=<?php echo $trend[2]['post_id']; ?>"><p class="shead"><?php echo substr($trend[2]['post_heading'],0,20);?></p></a>
								</div>
							</div>
						</div>
						<div class="col-sm-1"></div>
						<div class="col-sm-5" style="padding: 0px;">
							<div class="panel panel-default wow fadeInDown">
								<div class="panel-body" style="padding: 0px;">
									<img src="<?php echo $trend[3]['post_main_image'];?>" class="img-responsive"/>
									<a href="./articles_show.php?id=<?php echo $trend[3]['post_id']; ?>"><p class="shead"><?php echo substr($trend[3]['post_heading'],0,20);?></p></a>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
					<hr>
					</div>
					<div class="row">
						<div class="col-sm-5" style="padding: 0px;">
							<div class="panel panel-default wow fadeInUp">
								<div class="panel-body" style="padding: 0px;">
									<img src="<?php echo $trend[4]['post_main_image'];?>" class="img-responsive"/>
									<a href="./articles_show.php?id=<?php echo $trend[4]['post_id']; ?>"><p class="shead"><?php echo substr($trend[4]['post_heading'],0,20);?></p></a>
								</div>
							</div>
						</div>
						<div class="col-sm-1"></div>
						<div class="col-sm-5" style="padding: 0px;">
							<div class="panel panel-default wow fadeInDown">
								<div class="panel-body" style="padding: 0px;">
									<img src="<?php echo $trend[5]['post_main_image'];?>" class="img-responsive"/>
									<a href="./articles_show.php?id=<?php echo $trend[5]['post_id']; ?>"><p class="shead"><?php echo substr($trend[5]['post_heading'],0,20);?></p></a>
								</div>
							</div>
						</div>
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