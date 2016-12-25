<?php
	include_once './includes/index.php';
	$manage = new manage();
	if(isset($_POST['LEmail'])){
		session_start();
		if($manage->email_exists($_POST['LEmail'])){
			$password=md5($_POST['LPassword']);
			$login = $manage->login($_POST['LEmail'],$password);
			if($login > 0){
				$_SESSION['SID']=$login;
			}
			else{
				if($login == 0)
					$_SESSION['info']="INCORRECT PASSWORD / EMAIL";
				else
					$_SESSION['info']="ONLY APPROVED USERS CAN LOGIN";
			}
		}
		else{
			$_SESSION['info']="EMAIL NOT FOUND";
		}
		header("location:./manage.php");
	}
	elseif (isset($_POST['RegEmail'])) {
		$password=$_POST['RegPassword'];
		$cpassword=$_POST['RegcPassword'];
		session_start();
		if($password != $cpassword){
			$_SESSION['info']="PASSWORDS DONOT MATCH";
			header("location:./manage.php?task=register");
		}
		else{
			if($manage->email_exists($_POST['RegEmail'])){
				$_SESSION['info']="EMAIL ALREADY EXISTS";
				header("location:./manage.php?task=register");
			}
			else{
				$manage->register($_POST['RegName'],$_POST['RegEmail'],$_POST['RegcPassword']);
				if($manage){
					$_SESSION['info']="REGISTRATION SUCCESSFULL<br>LOGIN NEEDS APPROVAL";
					header("location:./manage.php");
				}
				else{
					$_SESSION['info']="REGISTRATION FAILED";
					header("location:./manage.php?task=register");
				}
			}
		}
	}
?>