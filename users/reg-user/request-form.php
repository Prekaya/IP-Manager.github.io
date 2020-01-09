<?php
session_start();
	$uID = $_SESSION['uID'];
	require($_SERVER['DOCUMENT_ROOT'].'/IP-Manager/linksandvars.php');
	require($statusCheck);
	userCheck();
	if(!empty($_POST)){
		$rDComputer = $_POST['rDComputer'];
		$rDeviceName = $_POST['rDeviceName'];
		$rMAC = $_POST['rMAC'];
		$rUID = $_POST['rUID'];
	
		require($databaseConnect);
	
		$stmt = $db->query("SELECT * FROM staff WHERE staff.staUID=$rUID");
		if($stmt->rowCount()>0){
			$gID = 2;
		}else{
			$gID = 1;
		}
	
		$sql = "INSERT INTO requests (rUID, rDComputer, rDeviceName, rMAC, rGateway) VALUES ('$rUID', '$rDComputer', '$rDeviceName', '$rMAC', '$gID')";
	
		if ($db->query($sql) == TRUE) {
			
			header('Location: http://localhost/IP-Manager/users/reg-user/requests.php');
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}
	
	?>
<!DOCTYPE html>
<html lang='en'>
	<head>
		<meta charset='UTF-8'/>
		<meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Request Form</title>
		<?php echo "<link rel='stylesheet' href='".$formcss."'/>"; ?>
	</head>
	<body>
		<div class='buttoncont'>
			<a href="<?php echo $userHome?>"><button>Go Back</button></a>
		</div>
		<header class='form-header'>
			<h1><em>Request to add a device</em></h1>
		</header>
		<form action = 'request-form.php' method='post' class='form'>
			<div class='form-row'>
				<label for='rDComputer'>Computer</label>
				<input id='rDComputer' name='rDComputer' type='text' placeholder='' required/>
			</div>
			<div class='form-row'>
				<label for='rDeviceName'>Device Name</label>
				<input id='rDeviceName' name='rDeviceName' type='text' placeholder='' required/>
			</div>
			<div class='form-row'>
				<label for='rMAC'>Devices MAC Address</label>
				<input id='rMAC' name='rMAC' type='text' placeholder='00:0a:95:9d:68:16' required/>
			</div>
			<input name='rUID' type='hidden' value='<?php echo $uID ?>' required>
			<div class='form-row'>
			<button>Submit</button>
			<div class='form-row'>
		</form>
	</body>
</html>