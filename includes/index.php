<?php
	require_once './includes/db_config.php';

	class index{
		public $db;
		public function __construct(){
			$this->db = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
			if(mysqli_connect_errno()){
				die ("Mysql Connection to Database Failed !");
			}
		}
		public function toppost(){
			$sql = "SELECT p.*,u.user_name FROM user_posts p,user_accounts u WHERE p.post_user = u.user_id ORDER BY post_likes DESC LIMIT 1";
			$result=mysqli_query($this->db,$sql);
			$post=mysqli_fetch_array($result);
			return $post;
		}
		public function trends(){
			$sql = "SELECT * FROM user_posts ORDER BY post_views DESC LIMIT 5";
			$result=mysqli_query($this->db,$sql);
			$posts[]=array();
			while ($post=$result->fetch_assoc()) {
				$posts[]=$post;
			}
			return $posts;
		}
		public function testimonals(){
			$sql="SELECT * FROM server_testimonals";
			$result=mysqli_query($this->db,$sql);
			$views[]=array();
			while($view=$result->fetch_assoc()){
				$views[]=$view;
			}
			return $views;
		}
		public function __destruct(){
			mysql_close();
		}
	}

	class blog{
		public $db;
		public function __construct(){
			$this->db = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
			if(mysqli_connect_errno()){
				die ("Mysql Connection to Database Failed !");
			}
		}
		public function ranks(){
			$sql="SELECT * FROM user_accounts ORDER BY user_posts DESC LIMIT 4";
			$result=mysqli_query($this->db,$sql);
			$users=array();
			while ($user=$result->fetch_assoc()) {
				$users[]=$user;
			}
			return $users;
		}
		public function headings($pageLimit,$setLimit){
			$sql="SELECT * FROM  user_posts ORDER BY post_id DESC LIMIT ".$pageLimit." , ".$setLimit;
			$result=mysqli_query($this->db,$sql);
			$heads=array();
			while($head=$result->fetch_assoc()){
				$heads[]=$head;
			}
			return $heads;
		}
		public function headings_cat($pageLimit,$setLimit,$cat){
			$sql="SELECT * FROM  user_posts WHERE post_categories = '$cat' ORDER BY post_id DESC LIMIT ".$pageLimit." , ".$setLimit;
			$result=mysqli_query($this->db,$sql);
			$heads=array();
			while($head=$result->fetch_assoc()){
				$heads[]=$head;
			}
			return $heads;
		}
		public function displayPaginationBelow($per_page,$page){
	   		$page_url="./blog.php?";
	    	$sql="SELECT post_user FROM  user_posts";
			$result=mysqli_query($this->db,$sql);
			$rec = $result->num_rows;
	    	$total = $rec;
	        $adjacents = "2"; 

	    	$page = ($page == 0 ? 1 : $page);  
	    	$start = ($page - 1) * $per_page;								
			
	    	$prev = $page - 1;							
	    	$next = $page + 1;
	        $setLastpage = ceil($total/$per_page);
	    	$lpm1 = $setLastpage - 1;
	    	
	    	$setPaginate = "";
	    	if($setLastpage > 1)
	    	{	
	    		$setPaginate .= "<ul class='setPaginate'>";
	                    $setPaginate .= "<li class='setPage'>Page $page of $setLastpage</li>";
	    		if ($setLastpage < 7 + ($adjacents * 2))
	    		{	
	    			for ($counter = 1; $counter <= $setLastpage; $counter++)
	    			{
	    				if ($counter == $page)
	    					$setPaginate.= "<li><a class='current_page'>$counter</a></li>";
	    				else
	    					$setPaginate.= "<li><a href='{$page_url}page=$counter'>$counter</a></li>";					
	    			}
	    		}
	    		elseif($setLastpage > 5 + ($adjacents * 2))
	    		{
	    			if($page < 1 + ($adjacents * 2))		
	    			{
	    				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
	    				{
	    					if ($counter == $page)
	    						$setPaginate.= "<li><a class='current_page'>$counter</a></li>";
	    					else
	    						$setPaginate.= "<li><a href='{$page_url}page=$counter'>$counter</a></li>";					
	    				}
	    				$setPaginate.= "<li class='dot'>...</li>";
	    				$setPaginate.= "<li><a href='{$page_url}page=$lpm1'>$lpm1</a></li>";
	    				$setPaginate.= "<li><a href='{$page_url}page=$setLastpage'>$setLastpage</a></li>";		
	    			}
	    			elseif($setLastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
	    			{
	    				$setPaginate.= "<li><a href='{$page_url}page=1'>1</a></li>";
	    				$setPaginate.= "<li><a href='{$page_url}page=2'>2</a></li>";
	    				$setPaginate.= "<li class='dot'>...</li>";
	    				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
	    				{
	    					if ($counter == $page)
	    						$setPaginate.= "<li><a class='current_page'>$counter</a></li>";
	    					else
	    						$setPaginate.= "<li><a href='{$page_url}page=$counter'>$counter</a></li>";					
	    				}
	    				$setPaginate.= "<li class='dot'>..</li>";
	    				$setPaginate.= "<li><a href='{$page_url}page=$lpm1'>$lpm1</a></li>";
	    				$setPaginate.= "<li><a href='{$page_url}page=$setLastpage'>$setLastpage</a></li>";		
	    			}
	    			else
	    			{
	    				$setPaginate.= "<li><a href='{$page_url}page=1'>1</a></li>";
	    				$setPaginate.= "<li><a href='{$page_url}page=2'>2</a></li>";
	    				$setPaginate.= "<li class='dot'>..</li>";
	    				for ($counter = $setLastpage - (2 + ($adjacents * 2)); $counter <= $setLastpage; $counter++)
	    				{
	    					if ($counter == $page)
	    						$setPaginate.= "<li><a class='current_page'>$counter</a></li>";
	    					else
	    						$setPaginate.= "<li><a href='{$page_url}page=$counter'>$counter</a></li>";					
	    				}
	    			}
	    		}
	    		
	    		if ($page < $counter - 1){ 
	    			$setPaginate.= "<li><a href='{$page_url}page=$next'>Next</a></li>";
	                $setPaginate.= "<li><a href='{$page_url}page=$setLastpage'>Last</a></li>";
	    		}else{
	    			$setPaginate.= "<li><a class='current_page'>Next</a></li>";
	                $setPaginate.= "<li><a class='current_page'>Last</a></li>";
	            }

	    		$setPaginate.= "</ul>\n";		
	    	}
	    
	    
	        return $setPaginate;
	    }
	    public function displayPaginationBelow_cat($per_page,$page,$cat){
	   		$page_url="./blog.php?";
	    	$sql="SELECT post_user FROM  user_posts WHERE post_categories ='$cat'";
			$result=mysqli_query($this->db,$sql);
			$rec = $result->num_rows;
	    	$total = $rec;
	        $adjacents = "2"; 

	    	$page = ($page == 0 ? 1 : $page);  
	    	$start = ($page - 1) * $per_page;								
			
	    	$prev = $page - 1;							
	    	$next = $page + 1;
	        $setLastpage = ceil($total/$per_page);
	    	$lpm1 = $setLastpage - 1;
	    	
	    	$setPaginate = "";
	    	if($setLastpage > 1)
	    	{	
	    		$setPaginate .= "<ul class='setPaginate'>";
	                    $setPaginate .= "<li class='setPage'>Page $page of $setLastpage</li>";
	    		if ($setLastpage < 7 + ($adjacents * 2))
	    		{	
	    			for ($counter = 1; $counter <= $setLastpage; $counter++)
	    			{
	    				if ($counter == $page)
	    					$setPaginate.= "<li><a class='current_page'>$counter</a></li>";
	    				else
	    					$setPaginate.= "<li><a href='{$page_url}page=$counter'>$counter</a></li>";					
	    			}
	    		}
	    		elseif($setLastpage > 5 + ($adjacents * 2))
	    		{
	    			if($page < 1 + ($adjacents * 2))		
	    			{
	    				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
	    				{
	    					if ($counter == $page)
	    						$setPaginate.= "<li><a class='current_page'>$counter</a></li>";
	    					else
	    						$setPaginate.= "<li><a href='{$page_url}page=$counter'>$counter</a></li>";					
	    				}
	    				$setPaginate.= "<li class='dot'>...</li>";
	    				$setPaginate.= "<li><a href='{$page_url}page=$lpm1'>$lpm1</a></li>";
	    				$setPaginate.= "<li><a href='{$page_url}page=$setLastpage'>$setLastpage</a></li>";		
	    			}
	    			elseif($setLastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
	    			{
	    				$setPaginate.= "<li><a href='{$page_url}page=1'>1</a></li>";
	    				$setPaginate.= "<li><a href='{$page_url}page=2'>2</a></li>";
	    				$setPaginate.= "<li class='dot'>...</li>";
	    				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
	    				{
	    					if ($counter == $page)
	    						$setPaginate.= "<li><a class='current_page'>$counter</a></li>";
	    					else
	    						$setPaginate.= "<li><a href='{$page_url}page=$counter'>$counter</a></li>";					
	    				}
	    				$setPaginate.= "<li class='dot'>..</li>";
	    				$setPaginate.= "<li><a href='{$page_url}page=$lpm1'>$lpm1</a></li>";
	    				$setPaginate.= "<li><a href='{$page_url}page=$setLastpage'>$setLastpage</a></li>";		
	    			}
	    			else
	    			{
	    				$setPaginate.= "<li><a href='{$page_url}page=1'>1</a></li>";
	    				$setPaginate.= "<li><a href='{$page_url}page=2'>2</a></li>";
	    				$setPaginate.= "<li class='dot'>..</li>";
	    				for ($counter = $setLastpage - (2 + ($adjacents * 2)); $counter <= $setLastpage; $counter++)
	    				{
	    					if ($counter == $page)
	    						$setPaginate.= "<li><a class='current_page'>$counter</a></li>";
	    					else
	    						$setPaginate.= "<li><a href='{$page_url}page=$counter'>$counter</a></li>";					
	    				}
	    			}
	    		}
	    		
	    		if ($page < $counter - 1){ 
	    			$setPaginate.= "<li><a href='{$page_url}page=$next'>Next</a></li>";
	                $setPaginate.= "<li><a href='{$page_url}page=$setLastpage'>Last</a></li>";
	    		}else{
	    			$setPaginate.= "<li><a class='current_page'>Next</a></li>";
	                $setPaginate.= "<li><a class='current_page'>Last</a></li>";
	            }

	    		$setPaginate.= "</ul>\n";		
	    	}
	    
	    
	        return $setPaginate;
	    }
		public function __destruct(){
			mysql_close();
		}
	}

	class post{
		public $db;
		public function __construct(){
			$this->db = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
			if(mysqli_connect_errno()){
				die ("Mysql Connection to Database Failed !");
			}
		}
		public function add_post($id,$heading,$content,$image,$cat){
			$time=time();
			$sql="INSERT INTO user_posts (post_user,post_heading,post_content,post_timestamp,post_main_image,post_categories) VALUES ('$id','$heading','".$content."','$time','$image','$cat')";
			$result=mysqli_query($this->db,$sql);
			return $result;
			
		}
		public function get_cat(){
			$sql="SELECT * FROM post_categories";
			$result=mysqli_query($this->db,$sql);
			$cats=array();
			while ($cat=$result->fetch_assoc()) {
				$cats[]=$cat;
			}
			return $cats;	
		}
		public function get_article($id){
			$sql = "SELECT p.*,u.* FROM user_posts p,user_accounts u WHERE p.post_user = u.user_id AND post_id = '$id'";
			$result=mysqli_query($this->db,$sql);
			$post=mysqli_fetch_array($result);
			return $post;
		}
		public function like($id){
			$sql="UPDATE user_posts SET post_likes = post_likes+1 WHERE post_id='$id'";
			$result=mysqli_query($this->db,$sql);
			if($result){
				return "You have added a like";
			}
		}
		public function unlike($id){
			$sql="UPDATE user_posts SET post_dislikes = post_dislikes+1 WHERE post_id='$id'";
			$result=mysqli_query($this->db,$sql);
			if($result){
				return "You have Unliked";
			}
		}
		public function add_view($id){
			$sql="UPDATE user_posts SET post_views = post_views +1 WHERE post_id ='$id'";
			$result=mysqli_query($this->db,$sql);
			return $result;
		}
		public function comments($id){
			$sql="SELECT c.*,u.* FROM user_comments c,user_accounts u WHERE c.cuser_id = u.user_id AND cpost_id='$id' ORDER BY id DESC";
			$result=mysqli_query($this->db,$sql);
			$comments=array();
			while ($comment=$result->fetch_assoc()) {
				$comments[]=$comment;
			}
			return $comments;
		}
		public function add_comment($user,$post,$content){
			$sql="INSERT INTO user_comments (cuser_id,cpost_id,comment) VALUES ('$user','$post','$content')";
			$result=mysqli_query($this->db,$sql);
			if($result){
				return "COMMENT SUCCESSFULL";
			}
			else{
				return "Failed To Comment";
			}
		}
		public function __destruct(){
			mysql_close();
		}
	}

	class manage{
		public $db;
		public function __construct(){
			$this->db = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
			if(mysqli_connect_errno()){
				die ("Mysql Connection to Database Failed !");
			}
		}
		public function login($email,$password){
			$sql="SELECT * FROM  user_accounts WHERE email = '$email'";
			$result=mysqli_query($this->db,$sql);
			$exists = $result->num_rows;
			if($exists >0){
				$user=$result->fetch_assoc();
				if($user['password'] == $password){
					if($user['approved']==1){
						return $user['user_id'];
					}
					else{
						return -1;
					}
				}
				else{
					return false;
				}
			}
			else{
				return false;
			}
		}
		public function get_user_details($id){
			$sql="SELECT * FROM user_accounts WHERE user_id = '$id'";
			$result=mysqli_query($this->db,$sql);
			$user=$result->fetch_assoc();
			return $user;
		}
		public function add_post_count($id){
			$sql="UPDATE user_accounts SET user_posts = user_posts +1 WHERE user_id = $id";
			$result=mysqli_query($this->db,$sql);
		}
		public function get_rank($post){
			if($post > 100){
				return "Golden Member";
			}
			elseif ($post > 50) {
				return "Silver Member";
			}
			else{
				return "Member";
			}
		}
		public function get_posts($id){
			$sql="SELECT * FROM  user_posts WHERE post_user = '$id'";
			$result=mysqli_query($this->db,$sql);
			$heads=array();
			while($head=$result->fetch_assoc()){
				$heads[]=$head;
			}
			return $heads;
		}
		public function email_exists($email){
			$sql="SELECT user_id FROM user_accounts WHERE email ='$email'";
			$result=mysqli_query($this->db,$sql);
			if($result->num_rows > 0){
				return true;
			}
			else{
				return false;
			}
		}
		public function register($name,$email,$password){
			$pass=md5($password);
			$sql="INSERT INTO user_accounts (email,user_name,password) VALUES ('$email','$name','$pass')";
			$result=mysqli_query($this->db,$sql);
			if($result){
				return true;
			}
			else{
				return false;
			}

		}
		public function update_user($id,$name,$dp){
			$sql="UPDATE user_accounts SET user_name = '$name' , user_dp = '$dp' WHERE user_id = '$id";
			$result=mysqli_query($this->db,$sql);
			if($result){
				return true;
			}
			else{
				return false;
			}
		}
		public function __destruct(){
			mysql_close();
		}
	}

	class contact{
		public function message($name,$email,$message){
			$name=strip_tags($name);
			$email=strip_tags($email);
			$message=strip_tags($message);
			$to="satheesh.101097@gmail.com, suresheagle02@gmail.com, aplussoftwares@gmail.com";
			$subject="APLUS TECH | CONTACT FORM | ".$name;
			$header="From:".$email."\r\n";
			$mail=mail($to, $subject, $message, $header);
			session_start();
			if($mail){
				$_SESSION['SERVER_INFO']="MESSAGE SENT SUCCESSFULLY";
			}
			else{
				$_SESSION['SERVER_INFO']="MESSAGE NOT SEND | CONTACT MANUALLY";
			}
			
		}
	}

	class server{
		public $db;
		public function __construct(){
			$this->db = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
			if(mysqli_connect_errno()){
				die ("Mysql Connection to Database Failed !");
			}
		}
		public function users(){
			$sql="SELECT user_id FROM user_accounts";
			$result=mysqli_query($this->db,$sql);
			return $result->num_rows;
		}
		public function posts(){
			$sql="SELECT post_id FROM user_posts";
			$result=mysqli_query($this->db,$sql);
			return $result->num_rows;
		}
		public function views(){
			$sql="SELECT id FROM server_ip_record";
			$result=mysqli_query($this->db,$sql);
			return $result->num_rows;
		}
		public function add_ip($ip,$id){
			$sql="INSERT INTO server_ip_record (ip,number) VALUES ('$ip','$id')";
			$result=mysqli_query($this->db,$sql);
			if($result){
				return true;
			}
			else{
				return false;
			}
		}
		public function __destruct(){
			mysql_close();
		}
	}
?>