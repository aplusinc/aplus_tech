<?php 
	$authinfo ="<div class=\"text-info text-center upper\">Kindly fill the details</div>";
	session_start();
	if(isset($_SESSION['info'])){
		$authinfo ="<div class=\"text-danger text-center upper\">{$_SESSION['info']}</div>";
		unset($_SESSION['info']);
	}
	
?>

<div class="container-fluid" style="padding-top: 80px;background-color: rgba(255,255,255,0.4);">
	<div class="row">
		<p class="lead text-center" title="APLUS USER LOGIN">REGISTER AN ACCOUNT</p>
		<hr class="bline "/>
		<div class="col-md-4"></div>
		<div class="col-md-4" style="margin-top: 50px;margin-bottom: 55px;">
			<div class="panel panel-default" style="background-color: rgba(0,0,0,0);border:0px solid black;">
				<div class="panel-body" style="background-color: rgba(255,255,255,0.5);border-radius: 5px;">
					<form action="./manager.php" method="POST" role="form" data-toggle="validator">
						<?php echo $authinfo; ?>
						<br>
						<div class="form-group">
		                      <input class="form-control" data-error="Must provide a Name to Register." id="inputName" placeholder="Full Name"  type="text" required name="RegName"/>
		                      <div class="help-block with-errors"></div>
	                  	</div>
						<br>
						<div class="form-group">
		                      <input class="form-control" data-error="Must provide a email to register." id="inputEmail" placeholder="Email Address"  type="email" required name="RegEmail"/>
		                      <div class="help-block with-errors"></div>
	                  	</div>
						<br>
						<div class="form-group">
		                      <input class="form-control" data-error="Must provide a password to register." id="inputPassword" placeholder="Password"  type="password" required name="RegPassword"/>
		                      <div class="help-block with-errors"></div>
	                  	</div>
	                  	<br>
						<div class="form-group">
		                      <input class="form-control" data-error="Must provide a password to register." id="inputPassword" placeholder="Confirm Password"  type="password" required name="RegcPassword"/>
		                      <div class="help-block with-errors"></div>
	                  	</div>
						<br>
						<button type="submit" class="btn btn-primary btn-block">REGISTER</button>
						<br><br>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>	