<?php   
	require("../linksandvars.php");
	
	$msg = '';
	
	if(!empty($_POST)){
		$uPassword = $_POST['password'];
		$uUsername = $_POST['username'];
		require($databaseConnect);
	
		$stmt = $db->query("SELECT uID, uPassword, uAdminStatus FROM users Where uUsername='$uUsername'");
	
		if($stmt->rowCount()>0){
			$data = $stmt->fetch();
	
			if(password_verify($uPassword, $data['uPassword'])){
				session_start();
				$_SESSION['uID']=$data['uID'];
				$_SESSION['uAdminStatus']=$data['uAdminStatus'];
	
				if($data['uAdminStatus']){
					header('Location: '.$adminHome);
				}else{
					header('Location: '.$userHome);
				}
			}
		}
	
		$msg = '<em>Your username or password is incorrect</em>';
	}
	?>
<!DOCTYPE html>
<html lang='en'>
	<head>
		<meta charset='UTF-8'/>
		<meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Login</title>
		<?php echo "<link rel='stylesheet' href='".$formcss."'/>"; ?>
	</head>
	<body>
		<header class='form-header'>
			<h1>Login</h1>
			<p>Please enter your user name and password</p>
		</header>
		<?php echo $msg ?>
		<form action='' method='post' class='form'>
			<div class='form-row'>
				<label for='username'>Username</label>
				<input id='username' name='username' type='email' required/>
			</div>
			<div class='form-row'>
				<label for='password'>Password</label>
				<input id='password' name='password' type='password' required/>
			</div>
			<div class='form-row'>
				<button>Login</button>
			</div>
		</form>
	</body>
</html>