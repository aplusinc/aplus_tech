<?php
	include_once("./includes/user_agent.php");
	$pageid=7;
	require_once './includes/index.php';
	if(isset($_GET["page"]))
	$item = (int)$_GET["page"];
	else
	$item = 1;

	$cat=$_GET['cat'];
	$setLimit = 10;
	$pageLimit = ($item * $setLimit) - $setLimit;

	$page=new blog();
	$rank= $page->ranks();
	$headings = $page->headings_cat($pageLimit,$setLimit,$cat);
	if(count($headings) < 1){
		echo "<h1>No Post Found On Server</h1>";
		exit();
	}
	$index = new index;
	$toppost = $index->toppost();
	$paginate = $page->displayPaginationBelow_cat($setLimit,$item,$cat);
	
?>
<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="theme-color" content="#191970">
		<link rel="shortcut icon" href="./images/favicon.png" type="image/x-icon">
		<title>APLUS TECH | BLOG</title>
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
				<div class="col-md-8">
					<p class="lead" title="APLUS TOP ARTICLES">APLUS TECH ARTICLES</p>
					<hr align="left" class="bline "/>
					<p class="text-right"><a href="./manage.php?task=post"><button type="button" class="btn btn-primary"><i class="fa fa-book">&nbsp;</i>New Thread</button></a></p>
					<br>
					<?php 
					$i=0;
					while($i<count($headings)){ ?>
					<a href="./articles_show.php/<?php echo $headings[$i]['post_id']; ?>">
					<div class="panel panel-default wow fadeInLeft" data-wow-delay=".<?php echo $i+1;?>s">
						<div class="panel-body head">
							<span class="number"><?php echo $i+1; ?></span>&nbsp;&nbsp;&nbsp;<span class="title"><?php echo $headings[$i]['post_heading']; ?>
						</div>
					</div>
					</a>
					<?php $i++; } ?>
					<div class="text-right">
						<?php echo $paginate; ?>
					</div>
				</div>
				<div class="col-md-1"></div>
				<div class="col-md-2 text-center">
					<p class="lead text-center" title="APLUS TOP ARTICLES">TOP POSTER</p>
					<hr  class="bline "/>
					<img src="<?php echo $rank[0]['user_dp']; ?>" style="width: 150px;" title="<?php echo $rank[0]['user_name']; ?> | RANK ONE" class="img-circle wow flip" data-wow-delay=".8s">
					<div class="panel panel-default" style="margin-top: 20px;">
						<div class="panel-body rank-one" style="text-transform: uppercase;">
							<?php echo $rank[0]['user_name']; ?>
						</div>
					</div>
					<p class="lead text-center" title="APLUS TOP POST">TOP POST</p>
					<hr  class="bline "/>
					<img src="<?php echo $toppost['post_main_image']; ?>" style="width: 150px;" title="<?php $toppost['post_heading']; ?> " class="img-rounded wow bounce" data-wow-delay=".8s">
					<div class="panel panel-default" style="margin-top: 20px;">
						<div class="panel-body rank-two" style="text-transform: uppercase;">
							<a href="articles_show.php/<?php echo $toppost['post_id']; ?>" style="color: yellow;"><?php echo $toppost['post_heading']; ?></a>
						</div>
					</div>
				</div>
				<div class="col-md-1"></div>
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