<?php
	$maintainance=0;
	if($maintainance == 1){
		header("location:./maintainance.php");
	}
?>
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
	<div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<img src="./images/logo.png" class="img-responsive navbar-brand wow fadeInLeft" alt="APLUS TECH BLOG LOGO" title="APLUS TECH BLOG LOGO">
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse navbar-ex1-collapse">
			<ul class="nav navbar-nav">
				<li><a href="#"></a></li>
				<?php if($pageid == 1){?>
					<li class="active"><a href="#" title="APLUS TECH - HOME"><i class="fa fa-home">&nbsp;</i>HOME</a></li>
				<?php }
				else{ ?>
					<li ><a href="./index.php" title="APLUS TECH - HOME"><i class="fa fa-home">&nbsp;</i>HOME</a></li>
				<?php	} ?>
				<?php if($pageid == 2){?>
					<li class="active"><a href="#" title="APLUS TECH - BLOG"><i class="fa fa-book">&nbsp;</i>BLOG</a></li>
				<?php }
				else{ ?>
					<li><a href="./blog.php" title="APLUS TECH - BLOG"><i class="fa fa-book">&nbsp;</i>BLOG</a></li>
				<?php } ?>
			</ul>
			<ul class="nav navbar-nav navbar-left">
				<?php if($pageid == 7){?>
				<li class="dropdown active">
				<?php }
				else{ ?>
				<li class="dropdown">
				<?php } ?>
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" title="APLUS TECH - CATEGORIES | DROPDOWN"><i class="fa fa-toggle-down">&nbsp;</i>CATEGORIES</a>
					<ul class="dropdown-menu wow fadeInDown" data-wow-delay=".2s">
						<li><a href="./cat.php?cat=INTERNET">INTERNET</a></li>
						<li><a href="./cat.php?cat=GADGET">GADGET</a></li>
						<li><a href="./cat.php?cat=MOBILE">MOBILE</a></li>
						<li><a href="./cat.php?cat=TECHNOLOGY">TECHNOLOGY</a></li>
						<li><a href="./cat.php?cat=BUSINESS">BUSINESS</a></li>
					</ul>
				</li>
				<?php if($pageid == 3){?>
					<li class="active"><a href="#" title="APLUS TECH - SITEMAP"><i class="fa fa-sitemap">&nbsp;</i>SITEMAP</a></li>
				<?php }
				else{ ?>
					<li><a href="./map.php" title="APLUS TECH - SITEMAP"><i class="fa fa-sitemap">&nbsp;</i>SITEMAP</a></li>
				<?php } ?>
				<?php if($pageid == 4){?>
					<li class="active"><a href="#" title="APLUS TECH - CONTACT"><i class="fa fa-phone">&nbsp;</i>CONTACT</a></li>
				<?php }
				else{ ?>
					<li><a href="./contact.php" title="APLUS TECH - CONTACT"><i class="fa fa-phone">&nbsp;</i>CONTACT</a></li>
				<?php } ?>
				<?php if($pageid == 5){?>
					<li class="active"><a href="#" title="APLUS TECH - ABOUT"><i class="fa fa-info">&nbsp;</i>ABOUT</a></li>
				<?php }
				else{ ?>
					<li><a href="./about.php" title="APLUS TECH - ABOUT"><i class="fa fa-info">&nbsp;</i>ABOUT</a></li>
				<?php } ?>
				<?php if($pageid == 6){?>
					<li class="active"><a href="./manage.php" title="APLUS TECH - MANAGE"><i class="fa fa-dashboard">&nbsp;</i>MANAGE</a></li>
				<?php }
				else{ ?>
					<li><a href="./manage.php" title="APLUS TECH - ABOUT"><i class="fa fa-dashboard">&nbsp;</i>MANAGE</a></li>
				<?php } ?>
			</ul>
		</div><!-- /.navbar-collapse -->
	</div>
</nav>