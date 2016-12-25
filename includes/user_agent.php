<?php
	$user_agent=$_SERVER['HTTP_USER_AGENT'];
	if(strpos($user_agent, "Firefox")){
		$agent="Firefox";
	}
	elseif(strpos($user_agent, "MSIE")){
		$agent="Internet Explorer";
	}
	elseif(strpos($user_agent, "Chromium")){
		$agent="Chromium";
	}
	elseif(strpos($user_agent, "Chrome")){
		$agent="Google Chrome";
	}
	elseif(strpos($user_agent, "Opera Mini")){
		$agent="Opera Mini";
	}
	elseif(strpos($user_agent, "Opera")){
		$agent="Opera";
	}
	else{
		$agent="Unknown Browser";
	}
	//Determining user os
	if(strpos($user_agent,"Linux")){
		$os="Linux";
		if(strpos($user_agent,"Ubuntu")){
			$os=$os." / Ubuntu";
			if(strpos($user_agent,"i686")){
				$os=$os." / i686";
			}
		}
		elseif(strpos($user_agent, "Android")){
			$os=$os." / Android";
		}
		else{
			$version="";
		}
		
	}
	elseif(strpos($user_agent,"Windows")){
		$os="Windows";
		if(strpos($user_agent,"Windows 8")){
			$os=$os." / 8";
		}
		elseif(strpos($user_agent, "Android")){
			$os=$os." / Android";
		}
	}
	elseif(strpos($user_agent, "Macintosh")){
		$os="Macintosh";
	}
	else{
		$os="Unknown Os";
	}
	$year = date("y");
?>