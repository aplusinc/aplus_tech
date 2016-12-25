<?php
	include_once("./includes/user_agent.php");
	include_once("./includes/index.php");
	//ID OF THE PAGE
	$pageid=1;
	$page= new index();
	$toppost = $page->toppost();
	$ttime=date('G:i A',$toppost['post_timestamp']);
	$tdate=date('d-m-y',$toppost['post_timestamp']);
	$topcontent=substr($toppost['post_content'], 0,379);
	$trend=$page->trends();
	$blog=new blog();
	$rank= $blog->ranks();
	$server=new server();
	if(!isset($_COOKIE['APLUS_TECH_ID'])){
		$rand=rand();
		$server->add_ip($_SERVER['REMOTE_ADDR'],$rand);
		if($server)
			setcookie('APLUS_TECH_ID',$rand,time()+3600*67*65);
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
		<title title="APLUS TECH">APLUS TECH</title>
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="./css/bootstrap.css">
		<link rel="stylesheet" href="./css/style.css">
		<link rel="stylesheet" href="./css/font-awesome.css">
		<link rel="stylesheet" href="./css/animate.css">
		<meta property="og:site_name" content="APLUS TECH">
		<meta property="og:title" content="APLUS TECH | INDEX" />
		<meta property="og:image" content="http://aplusdemo.rf.gd/images/favicon.png">
		<meta property="og:description" content="Aplus Tech Is One Of The Leading Technology Blog From India Implemented With A Goal To Spread The Knowledge On Technology." />
		<meta property="author" content="Satheesh Kumar"/>
		<meta property="og:type" content="webpage" />
		<meta property="description" content="Aplus Tech Is One Of The Leading Technology Blog From India Implemented With A Goal To Spread The Knowledge On Technology." />
		
	</head>
	<body>
		<?php include_once './includes/header.php'; ?>
		<div class="container-fluid" style="padding-top: 80px;background-color: rgba(255,255,255,0.4);">
			<div class="row">
				<div class="col-md-9">
					<p class="lead" title="APLUS TOP ARTICLE">TOP ARTICLE</p>
					<hr align="left" class="bline wow fadeInLeft"/>
					<div class="panel panel-default">
						<div class="panel-body" style="padding: 0px;">
							<div class="col-sm-3" style="padding: 0px;">
								<img src="<?php echo $toppost['post_main_image']; ?>" class="img-responsive" />
							</div>
							<div class="col-sm-8">
								<h3 class="rheading">
									<?php echo $toppost['post_heading']; ?>
								</h3>
								<hr align="left" class="hline wow fadeInRight"/>
								<p class="details"><i class="fa fa-user">&nbsp;</i><a class="link_name" href="./user.php?id=<?php echo $toppost['post_user']; ?>"><?php echo $toppost['user_name'];?></a>&nbsp;&nbsp;<i class="fa fa-calendar">&nbsp;</i><?php echo $tdate;?>&nbsp;&nbsp;<i class="fa fa-clock-o">&nbsp;</i><?php echo $ttime;?></p>
								<p><?php echo strip_tags($topcontent); ?>
									<a href="articles_show.php?id=<?php echo $toppost['post_id'];?>">[.....]</a>
								</p>
							</div>
						</div>
					</div>
					<div class="panel panel-default" style="margin-top: 50px;background-color: rgba(255,255,255,0);border:0px solid white;" title="APLUS TECH TRENDS">
						<div class="panel-body" style="background-color: rgba(255,255,255,0);padding:0px;padding-bottom:-50px;border:0px solid white;">
							<div class="col-sm-1">
							<h3>
								T<br>R<br>E<br>N<br>D<br>S
							</h3>
							</div>
							<div class="col-sm-2" style="padding: 0px;">
								<div class="panel panel-default wow fadeInUp">
									<div class="panel-body" style="padding: 0px;">
										<img src="<?php echo $trend[2]['post_main_image'];?>" class="img-responsive"/>
										<a href="./articles_show.php?id=<?php echo $trend[2]['post_id']; ?>"><p class="shead"><?php echo substr($trend[2]['post_heading'],0,30);?></p></a>
									</div>
								</div>
							</div>
							<div class="col-sm-1" style="padding: 0px;"></div>
							<div class="col-sm-2" style="padding: 0px;">
								<div class="panel panel-default wow fadeInDown">
									<div class="panel-body" style="padding: 0px;">
										<img src="<?php echo $trend[3]['post_main_image'];?>" class="img-responsive"/>
										<a href="./articles_show.php?id=<?php echo $trend[3]['post_id']; ?>"><p class="shead"><?php echo substr($trend[3]['post_heading'],0,30);?></p></a>
									</div>
								</div>
							</div>
							<div class="col-sm-1" style="padding: 0px;"></div>
							<div class="col-sm-2" style="padding: 0px;">
								<div class="panel panel-default wow fadeInUp">
									<div class="panel-body" style="padding: 0px;">
										<img src="<?php echo $trend[4]['post_main_image'];?>" class="img-responsive"/>
										<a href="./articles_show.php?id=<?php echo $trend[4]['post_id']; ?>"><p class="shead"><?php echo substr($trend[4]['post_heading'],0,30);?></p></a>
									</div>
								</div>
							</div>
							<div class="col-sm-1" style="padding: 0px;"></div>
							<div class="col-sm-2" style="padding: 0px;">
								<div class="panel panel-default wow fadeInDown">
									<div class="panel-body" style="padding: 0px;">
										<img src="<?php echo $trend[5]['post_main_image'];?>" class="img-responsive"/>
										<a href="./articles_show.php?id=<?php echo $trend[5]['post_id']; ?>"><p class="shead"><?php echo substr($trend[5]['post_heading'],0,30);?></p></a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<p class="lead" title="APLUS SOCIAL WIDGETS">SOCIAL WIDGETS</p>
					<hr align="left" class="hline  wow fadeInLeft"/>
					<a href="http://fb.com/aplusoftwares">
						<div class="panel panel-default wow fadeInUp">
							<div class="panel-body fb" style="padding:5px;">
								<img src="./images/fb.png" style="width: 30px;">
								Like us on Facebook
							</div>
						</div>
					</a>
					<a href="http://twitter.com">
						<div class="panel panel-default wow fadeInDown">
							<div class="panel-body twitter" style="padding:5px;">
								<img src="./images/twit.png" style="width: 30px;">
								Follow us on twitter
							</div>
						</div>
					</a>
					<a href="http://google.com/">
						<div class="panel panel-default wow fadeInUp">
							<div class="panel-body gplus" style="padding:5px;">
								<img src="./images/gplus.png" style="width: 30px;">
								Add us to your circle
							</div>
						</div>
					</a>
					<a href="http://youtube.com">
						<div class="panel panel-default wow fadeInDown">
							<div class="panel-body youtube" style="padding:5px;">
								<img src="./images/you.png" style="width: 30px;">
								Subscribe us on Youtube
							</div>
						</div>
					</a>
					<div class="panel panel-default" style="margin-top: 54px;padding-bottom: 10px;">
						<div class="panel-body">
							<a href="http://aplusinc.github.io">
								<p class="text-center">CHEAP WEB HOSTING</p>
								<img src="http://localhost/Aplus_Inc/images/logo.png" class="img-responsive">
							</a>
							<p>
								Aplus is a web designing company that is provinding wed designs for very low price.
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="container-fluid" style="padding-top: 70px;background-color: rgba(255,255,255,0.4);padding-bottom: 50px;">
			<div class="row">
				<div class="col-md-5">
					<p class="lead" title="APLUS TESTIMONALS">WHAT USERS SAY?</p>
					<hr align="left" class="bline wow fadeInLeft"/>
					<div class="panel panel-default wow fadeInUp" data-wow-delay=".5s">
						<div class="panel-body">
							"One Of The Best Blog Design"
						</div>
					</div>
					<div class="panel panel-default wow fadeInDown" data-wow-delay=".5s">
						<div class="panel-body">
							"Update Your Tech With Aplus Tech"
						</div>
					</div>
					<div class="panel panel-default wow fadeInUp" data-wow-delay=".5s">
						<div class="panel-body">
							"Very User Friendly"
						</div>
					</div>
					<div class="panel panel-default wow fadeInDown" data-wow-delay=".5s">
						<div class="panel-body">
							"Very Intresting Articles"
						</div>
					</div>
				</div>
				<div class="col-md-1"></div>
				<div class="col-md-6">
					<p class="lead" title="APLUS TOP BLOGGERS">TOP BLOGGERS</p>
					<hr align="left" class="bline wow fadeInLeft"/>
					<br><br>
					<div class="col-sm-4 text-center">
						<img src="<?php echo $rank[1]['user_dp']; ?>" style="width: 150px;" title="<?php echo $rank[1]['user_name']; ?> | RANK TWO" class="img-circle wow fadeInRight" data-wow-delay=".8s">
						<div class="panel panel-default" style="margin-top: 20px;">
							<div class="panel-body rank-two text-center" style="text-transform: uppercase;">
								<?php echo $rank[1]['user_name']; ?>
							</div>
						</div>
					</div>
					<div class="col-sm-4 text-center">
						<img src="<?php echo $rank[0]['user_dp']; ?>" style="width: 150px;" title="<?php echo $rank[0]['user_name']; ?> | RANK ONE" class="img-circle wow flip" data-wow-delay=".3s">
						<div class="panel panel-default" style="margin-top: 20px;">
							<div class="panel-body rank-one text-center" style="text-transform: uppercase;">
								<?php echo $rank[0]['user_name']; ?>
							</div>
						</div>
					</div>
					<div class="col-sm-4 text-center">
						<img src="<?php echo $rank[2]['user_dp']; ?>" style="width: 150px;" title="<?php echo $rank[2]['user_name']; ?> | RANK THREE" class="img-circle wow fadeInLeft" data-wow-delay=".8s">
						<div class="panel panel-default" style="margin-top: 20px;">
							<div class="panel-body rank-three text-center" style="text-transform: uppercase;">
								<?php echo $rank[2]['user_name']; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="container-fluid" style="padding-top: 50px;background-color: rgba(255,255,255,0.4);padding-bottom: 50px;">
			<div class="row">
				<div class="col-md-12">
					<p class="lead text-center" title="APLUS POWERED WITH">WEBSITE POWERED WITH</p>
					<hr align="center" class="bline wow fadeInLeft"/>
					<div class="text-center" style="word-spacing: 200px;padding-top: 20px;padding-bottom: 20px;">
						<img src="./images/html-logo.png" width="150px;">
						<img src="./images/bootstrap-logo.png" width="150px;">
						<img src="./images/jquery.gif" width="150px;">
						<img src="./images/php-mysql.png" width="150px;">
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