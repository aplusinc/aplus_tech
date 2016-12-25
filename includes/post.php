
<?php
	session_start();
	if(isset($_SESSION['SID'])){
		$user=$_SESSION['SID'];
	}
	else{
		header("location:./manage.php");
	}
	if(isset($_POST['heading'])){
		$title=strip_tags($_POST['heading']);
		$content=addslashes($_POST['content']);
		$res=$post->add_post($user,$title,$content,$_POST['image'],$_POST['category']);
		if($res > 0){
			$manage->add_post_count($user);
			header("location:./blog.php");
		}
		else{
			echo $res;
			exit();
		}
	}
	$cat=$post->get_cat();
?>

<!-- Posting Page -->

<div class="container-fluid" style="padding-top: 80px;background-color: rgba(255,255,255,0.4);">
	<div class="row">
		<div class="col-md-8">
			<p class="lead" title="APLUS START A NEW THREAD">START A NEW THREAD</p>
			<hr align="left" class="bline "/>
			<form action="./manage.php?task=post" method="POST" role="form">
				<br>
				<div class="form-group">
					<div class="col-sm-6" style="padding:0px;">
					<input type="text" class="form-control" id="heading" placeholder="Article Title" name="heading" required style="text-transform: capitalize;">
					</div>
					<div class="col-sm-1"></div>
					<div class="col-sm-5" style="padding:0px;">
						<select name="category" id="input" class="form-control" required="">
							<option value="">-- Select Category --</option>
							<?php 
							$i=0;
							while($i< count($cat)){?>
								<option value="<?php echo $cat[$i]['cat_name'];?>"><?php echo $cat[$i]['cat_name'];?></option>
							<?php $i++;}?>
						</select>
					</div>
				</div>
				<br>
				<br>
				<div class="form-group">
					<input type="text" class="form-control" id="heading" placeholder="Main Image link max: (1500px X 1500px)" name="image" required>
				</div>
				<br>
				<div class="form-group">
				<textarea name="content" id="summernote" row="10" required="">HELLO APLUS TECH</textarea>
				</div>

				<div class="form-group text-right">
					<button type="button" onclick="update()" class="btn btn-success">PREVIEW</button>
					<button type="submit" class="btn btn-primary">POST</button>
				</div>
			</form>
		</div>
		<div class="col-md-4">
			<p class="lead" title="APLUS START A NEW THREAD">POST PREVIEW</p>
			<hr align="left" class="bline "/>
			<div id="preview" style="word-wrap: normal;word-break: normal;">HELLO APLUS TECH</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	function update() {
		console.log('update');
		document.getElementById('preview').innerHTML=document.getElementById('summernote').value;
	}
</script>
