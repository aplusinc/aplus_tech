<?php
	include_once("./includes/user_agent.php");
	$pageid=0;
	include_once './includes/index.php';
	$server="http://aplusdemo.rf.gd";
	$url=array();
	$url=explode("/", $_SERVER['REQUEST_URI']);
	$post_id=$url[2];
	session_start();
	$article=new post();
	if(isset($_SESSION['SID'])){
		$isloggedin=1;
	}
	if($_SESSION['viewed'] != $post_id){
		$viewed=$article->add_view($post_id);
		$_SESSION['viewed']=$post_id;
	}
	$post=$article->get_article($post_id);
	if(count($post) < 1){
		echo "THE REQUESTED POST IS NOT FOUND ON SERVER";
		exit();
	}
	$ttime=date('G:i A',$post['post_timestamp']);
	$tdate=date('d-m-y',$post['post_timestamp']);
	$comments=$article->comments($post_id);
	$total_comments=count($comments);
	if($_GET['action'] == "unlike"){
		if($_COOKIE['UNLIKED'] != $post_id){
			$likeinfo=$article->unlike($post_id);
			setcookie("UNLIKED",$post_id,0);
		}
	}
	if($_GET['action'] == "like"){
		if($_COOKIE['LIKED'] != $post_id){
			$likeinfo=$article->like($post_id);
			setcookie("LIKED",$post_id,0);
		}
	}
	if($_POST['comment']){
		if($_POST['comment'] != "" || $_POST['comment'] != null){
			$add_comment=$article->add_comment($_SESSION['SID'],$post_id,$_POST['comment']);
			$cmt_info=$add_comment;
			header("location:./articles_show.php?id=".$post_id."#comment");
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
    $script   = $_SERVER['REQUEST_URI'];
	//next we do a bit of string manipulation to convert output like HTTP/1.1 to http
    $protocol=strpos(strtolower($_SERVER['SERVER_PROTOCOL']),'https') 
                === FALSE ? 'http' : 'https';
 
	//now the final part to concatenate all this together to form the URL
    $FinalUrl = $protocol . '://' . $domain. $script;
	
?>


<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" href="<?php echo $server; ?>/images/favicon.png" type="image/x-icon">
		<meta name="title" content="<?php echo $post['post_heading']; ?>">
		<meta name="description" content="<?php echo strip_tags(substr($post['post_content'],0,500))."......"; ?>">
		<meta property="fb:app_id" content="1326818747389673">
		<meta property="og:title" content="<?php echo $post['post_heading']; ?>">
		<meta property="og:type" content="article">
		<meta property="og:url" content="<?php echo $FinalUrl; ?>">
		<meta property="og:image" content="<?php echo $post['post_main_image']; ?>">
		<meta property="og:description" content="<?php echo strip_tags(substr($post['post_content'],0,500))."......"; ?>">
		<meta property="article:author" content="<?php echo $post['user_name']; ?>" />
		<title><?php echo $post['post_heading']; ?></title>
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="<?php echo $server; ?>/css/bootstrap.css">
		<link rel="stylesheet" href="<?php echo $server; ?>/css/style.css">
		<link rel="stylesheet" href="<?php echo $server; ?>/css/font-awesome.css">
		<link rel="stylesheet" href="<?php echo $server; ?>/css/animate.css">
		<meta name="theme-color" content="#191970">
	</head>
	<script>
		window.fbAsyncInit = function() {
		    FB.init({
		      appId      : '1326818747389673',
		      xfbml      : true,
		      version    : 'v2.8'
		    });
		};

		(function(d, s, id){
		    var js, fjs = d.getElementsByTagName(s)[0];
		    if (d.getElementById(id)) {return;}
		    js = d.createElement(s); js.id = id;
		    js.src = "//connect.facebook.net/en_US/sdk.js";
		    fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
	</script>
	<body>
		<?php include_once './includes/aheader.php'; ?>
		<div class="container wow fadeInDown" style="padding-top: 80px;min-height: 700px;background-color: white;box-shadow: 2px 1px 1px 2px grey;">

			<div class="row">
				<div class="col-lg-12" >
					<div class="panel panel-default" style="background-color: rgba(255,255,255,0);border:0px solid white;">
						<div class="panel-body" style="background-color: rgba(255,255,255,1);padding: 0px;padding-right: 25px;padding-left: 25px">
							<h2 style="text-transform: capitalize;letter-spacing: 1px;word-spacing: 3px;" class="wow fadeInLeft" data-wow-delay=".7s"><?php echo $post['post_heading']; ?></h2>
							<hr align="left" class="bline wow fadeInLeft" data-wow-delay=".8s">
							<p class="details wow fadeInLeft" data-wow-delay=".9s"><i class="fa fa-user">&nbsp;</i><a class="link_name" href="<?php echo $server; ?>/user.php?id=<?php echo $post['post_user']; ?>"><?php echo $post['user_name'];?></a>&nbsp;&nbsp;&nbsp;<i class="fa fa-calendar">&nbsp;</i><?php echo $tdate;?>&nbsp;&nbsp;&nbsp;<i class="fa fa-clock-o">&nbsp;</i><?php echo $ttime;?>&nbsp;&nbsp;&nbsp;<i class="fa fa-eye">&nbsp;</i><?php echo $post['post_views'];?>
							&nbsp;&nbsp;&nbsp;<i class="fa fa-thumbs-up">&nbsp;</i><?php echo $post['post_likes'];?>&nbsp;&nbsp;&nbsp;<i class="fa fa-thumbs-down">&nbsp;</i><?php echo $post['post_dislikes'];?>
							</p>

							<div class="posted" style="font-size:20px;margin-top: 40px;line-height: 25px;word-spacing: 2px;font-family: jose;">
								<?php echo stripslashes($post['post_content']); ?>
								<div class="panel panel-info wow fadeInRight" data-wow-delay="1s" id="like">
									<div class="panel-body">
										<p>WAS THIS POST USEFULL&nbsp;&nbsp;&nbsp;
										<a href="<?php echo $server; ?>/articles_show.php/<?php echo $post['post_id'];?>/?action=like">
										<button type="button" class="btn btn-sm btn-success">YES</button>
										</a>
										<a href="<?php echo $server; ?>/articles_show.php/<?php echo $post['post_id'];?>?action=unlike">
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
					<div id="disqus_thread"></div>
					<script>


					var disqus_config = function () {
					this.page.url = "<?php echo $FinalUrl; ?>";  // Replace PAGE_URL with your page's canonical URL variable
					this.page.identifier = "<?php echo $post_id; ?>"; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
					};
					(function() { // DON'T EDIT BELOW THIS LINE
					var d = document, s = d.createElement('script');
					s.src = '//aplustech.disqus.com/embed.js';
					s.setAttribute('data-timestamp', +new Date());
					(d.head || d.body).appendChild(s);
					})();
					</script>
					<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
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
									<a href="<?php echo $server; ?>/articles_show.php/<?php echo $trend[2]['post_id']; ?>"><p class="shead"><?php echo substr($trend[2]['post_heading'],0,20);?></p></a>
								</div>
							</div>
						</div>
						<div class="col-sm-1"></div>
						<div class="col-sm-5" style="padding: 0px;">
							<div class="panel panel-default wow fadeInDown">
								<div class="panel-body" style="padding: 0px;">
									<img src="<?php echo $trend[3]['post_main_image'];?>" class="img-responsive"/>
									<a href="<?php echo $server; ?>/articles_show.php/<?php echo $trend[3]['post_id']; ?>"><p class="shead"><?php echo substr($trend[3]['post_heading'],0,20);?></p></a>
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
									<a href="<?php echo $server; ?>/articles_show.php/<?php echo $trend[4]['post_id']; ?>"><p class="shead"><?php echo substr($trend[4]['post_heading'],0,20);?></p></a>
								</div>
							</div>
						</div>
						<div class="col-sm-1"></div>
						<div class="col-sm-5" style="padding: 0px;">
							<div class="panel panel-default wow fadeInDown">
								<div class="panel-body" style="padding: 0px;">
									<img src="<?php echo $trend[5]['post_main_image'];?>" class="img-responsive"/>
									<a href="<?php echo $server; ?>/articles_show.php/<?php echo $trend[5]['post_id']; ?>"><p class="shead"><?php echo substr($trend[5]['post_heading'],0,20);?></p></a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php include_once("./includes/footer.php"); ?>
		<!-- jQuery -->
		<script src="<?php echo $server; ?>/js/jquery-3.1.1.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="<?php echo $server; ?>/js/bootstrap.js"></script>
		<script src="<?php echo $server; ?>/js/wow.js"></script>
		<script>
            new WOW().init();
        </script>
        <script id="dsq-count-scr" src="//EXAMPLE.disqus.com/count.js" async></script>
	</body>
</html>