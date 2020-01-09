<?php   
	require($_SERVER['DOCUMENT_ROOT'].'/IP-Manager/linksandvars.php'); 
	require($statusCheck);
	adminCheck();
	
	if(!empty($_POST)){
		require($databaseConnect);

		$dID = $_POST['dID'];
		$dUID = $_POST['dUID'];
		if($_POST['action'] == 'delete'){
			$stmt = "DELETE FROM devices WHERE dID = '$dID'";
			if ($db->query($stmt) == TRUE) {
				$stmt = $db->query("SELECT uNumDevices FROM users WHERE uID = $dUID");
				$data = $stmt->fetch();
				$newNumDevices = $data['uNumDevices']-1;
				$stmt = "UPDATE users SET uNumDevices = '$newNumDevices' WHERE uID = '$dUID'";
				$db->query($stmt);
				header('Location: '.$adminDevices);
			} else {
				echo "Error: ".$db."<br>".$stmt->error;
			}
		}else{
			header('Location: '.$adminDevices);
		}
			
		
		
	}
	?>
<!DOCTYPE html>
<html lang='en'>
	<head>
		<meta charset='utf-8'/>
		<meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Device Form</title>
		<?php 
			echo "<link rel='stylesheet' href='".$delFormcss."'/>";
			?>
	</head>
	<body>
		<div class = 'buttoncont'>
			<a href='<?php echo $adminDevices?>'><button>Go Back</button></a>
		</div>
		<?php
			require($databaseConnect);
			$dID = $_GET['id'];
			$stmt = $db->query("SELECT * FROM devices JOIN gateways ON gateways.gID = devices.dGID WHERE dID=".$dID);
			$result = $stmt->fetch();
			$dUID = $result['dUID'];
			?>
		<header class='form-header'>
			<h1>Delete Device Form</h1>
			<h2>Are you sure you want to delete this device?</h2>
			<div class = 'deviceDescription'>
				<h3><em>Computer: <?php echo $result['dComputer']?></em></h3>
				<h3><em>Device Name: <?php echo $result['dDeviceName']?></em></h3>
				<h3><em>Gateway:<?php echo $result['gName']?></em></h3>
			</div>

		</header>
		
		<form action='' method='post' class='form'>
			<input id='dID' name='dID' type="hidden" value=<?php echo '"'.$dID.'"'; ?>/>
			<input id='dUID' name='dUID' type="hidden" value=<?php echo '"'.$dUID.'"'; ?>/>			

			<div class='form-row'>
				<button type="submit" name="action" value="delete">Delete Device</button>
			</div>

			<div class='form-row'>
				<button type="submit" name="action" value="cancel">Cancel</button>
			</div>
		</form>
	</body>
</html>