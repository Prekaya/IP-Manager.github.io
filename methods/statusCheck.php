<?php
	function sessionCheck(){
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
	}


	function adminCheck(){
		sessionCheck();
		if(isset($_SESSION['uAdminStatus'])) {
			if(!$_SESSION['uAdminStatus']) {
				header('Location: http://localhost/IP-Manager/users/login.php');
			}
		}else{
			header('Location: http://localhost/IP-Manager/users/login.php');
		}
	}

	function userCheck(){
		sessionCheck();
		
		if(isset($_SESSION['uAdminStatus'])) {
			$uID = $_SESSION['uID'];
		}else{
			header('Location: '.$loginPage);
		}
	}

	function folderCheck(){
		sessionCheck();
		
		if(isset($_SESSION['uAdminStatus'])) {
			if($_SESSION['uAdminStatus']) {
				header('Location: '.$adminHome);
			}else {
				header('Location: '.$login);
			}
		}else{
			header('Location: http://localhost/IP-Manager/users/login.php');
		}
	}
	?>