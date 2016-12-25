<?php
	$id=0;
	session_start();
	$id=$_SESSION['SID'];
	$user=$manage->get_user_details($id);
	$rank=$manage->get_rank($user['user_posts']);
	$post=$manage->get_posts($id);
	if(isset($_POST['name'])){
		$update=$manage->update_user($id,$_POST['name'],$_POST['dp']);
		if($update){
			$info="SUCCESSFULL";
		}
		else{
			$info="FAILED";
		}
	}
?>
	<div class="modal fade" id="modal-id">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">UPDATE USER PROFILE</h4>
				</div>

				<div class="modal-body">
				<form action="./manage.php" method="POST" role="form">
					<div class="form-group">
						<input type="text" class="form-control" id="" placeholder="Full Name" value="<?php echo $user['user_name']; ?>" required="" name="name">
					</div>
					<div class="col-sm-2">
						<img src="<?php echo $user['user_dp']; ?>" class="img-responsive"/><br>
					</div>
					<div class="form-group">
						<input type="url" class="form-control" id="" placeholder="New Image Link" value="<?php echo $user['user_dp']; ?>" required="" name="dp">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">UPDATE</button>
					</from>
				</div>
			</div>
		</div>
	</div>
<div class="container-fluid" style="padding-top: 80px;background-color: rgba(255,255,255,0.4);">
	<div class="row">
		<p class="text-center lead" title="APLUS START ACCOUNT MANAGER">APLUS TECH DASHBOARD </p>
		<hr class="bline "/>
		<div class="col-lg-6" style="padding-bottom: 50px;">
			<div class="col-sm-4">
				<img src="<?php echo $user['user_dp']; ?>" class="img-responsive"/>
			</div>
			<div class="col-sm-8" style="padding-top: 4px;">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="col-xs-9">
							<p class="lead"><i class="fa fa-user">&nbsp;</i><?php echo $user['user_name']; ?></p>
							<p><i class="fa fa-envelope">&nbsp;&nbsp;</i><?php echo $user['email']; ?></p><br>
							<p class="lead"><i class="fa fa-book">&nbsp;</i> <?php echo $user['user_posts']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-certificate">&nbsp;</i> <?php echo $rank; ?></p>
							<?php echo $info; ?>
						</div>
						<div class="col-xs-3 text-right">
							<a class="btn btn-danger" href='./manage.php?task=logout' title="LOGOUT"><i class="fa fa-sign-out"></i></a>
							<br><br><br><br>
							<a class="btn btn-warning" data-toggle="modal" href='#modal-id' title="EDIT PROFILE"><i class="fa fa-edit"></i></a>
						</div>
					</div>
				</div>
				<br><br>

			</div>
			<p class="text-center lead" title="APLUS START ACCOUNT MANAGER">USER POSTS </p>
			<hr class="bline "/>
			<p class="text-right"><a href="./manage.php?task=post"><button type="button" class="btn btn-primary"><i class="fa fa-book">&nbsp;</i>New Thread</button></a></p><br>
			<div class="flexcroll">
			<?php 
				$i=0;
				while($i<count($post)){ ?>
				<a href="./articles_show.php?id=<?php echo $post[$i]['post_id']; ?>">
				<div class="panel panel-default wow fadeInDown" data-wow-delay=".<?php echo $i+1;?>s">
					<div class="panel-body head">
						<span class="number"><?php echo $i+1; ?></span>&nbsp;&nbsp;&nbsp;<span class="title"><?php echo $post[$i]['post_heading']; ?></span><span class="pull-right tag">#<?php echo $post[$i]['post_categories']; ?></span>
					</div>
				</div>
				</a>
			<?php $i++; } ?>
			</div>
		</div>
		<div class="col-lg-6" style="padding-bottom: 50px;">
			<p class="text-center lead" title="APLUS START ACCOUNT MANAGER">SERVER STATISTICS </p>
			<hr class="bline "/>
			<div class="col-sm-4">
				<div class="panel panel-default" style="background-color: #4B0082;">
					<div class="panel-body" style="padding: 0px;padding-top: 25px;">
						<p class="lead text-center coda"><?php echo $server->posts(); ?></p>
						<div class="indicator">
							POSTS
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="panel panel-default" style="background-color: #008080;">
					<div class="panel-body" style="padding: 0px;padding-top: 25px;">
						<p class="lead text-center coda"><?php echo $server->users(); ?></p>
						<div class="indicator">
							USERS
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="panel panel-default" style="background-color: #C71585;">
					<div class="panel-body" style="padding: 0px;padding-top: 25px;">
						<p class="lead text-center coda"><?php echo $server->views(); ?></p>
						<div class="indicator">
							VIEWS
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>