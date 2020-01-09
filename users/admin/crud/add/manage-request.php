<?php   
	require($_SERVER['DOCUMENT_ROOT'].'/IP-Manager/linksandvars.php'); 
	require($statusCheck);
	adminCheck();
	
	if(!empty($_POST)){
		require($databaseConnect);

		$dComputer = strtolower($_POST['rDComputer']);
		$dDeviceName = strtolower($_POST['rDeviceName']);
		$dMAC = $_POST['rMAC'];
		$dIPID = $_POST['dIPID'];
		$dUID = $_POST['rUID'];
		$dGID = $_POST['rGateway'];
		$dDescription = strtolower($_POST['dDescription']);
	
		$stmt = "INSERT INTO devices (dComputer, dDeviceName, dMAC, dGID, dIPID, dUID, dDescription) VALUES ('$dComputer', '$dDeviceName', '$dMAC', '$dGID', '$dIPID', '$dUID', '$dDescription')";
	
	
		if ($db->query($stmt) == TRUE) {
			$stmt = $db->query("SELECT uNumDevices FROM users WHERE uID = $dUID");
			$data = $stmt->fetch();
			$newNumDevices = $data['uNumDevices']+1;
			$stmt = "UPDATE users SET uNumDevices = '$newNumDevices' WHERE uID = '$dUID'";
			$db->query($stmt);
			$db = null;
			$stmt = "UPDATE request SET rStatus = 1 WHERE rID = '$rID'";
			$db = null;
			header('Location: '.$adminHome);
		} else {
			echo "Error: ".$stmt."<br>".$db->error;
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
			echo "<link rel='stylesheet' href='".$chosen."chosen.css'/>";
			echo "<link rel='stylesheet' href='".$formcss."'/>";
			?>
	</head>
	<body>
		<div class = 'buttoncont'>
			<a href='<?php echo $adminHome?>'><button>Go Back</button></a>
		</div>
		<header class='form-header'>
			<h1>Edit Device Form</h1>
			<p><em>Edit devices in the database using this form.</em></p>
		</header>
		<?php
			require($databaseConnect);
			$rID = $_GET['id'];
			$stmt = $db->query("SELECT * FROM requests WHERE rID=".$rID);
			$result = $stmt->fetch();
			?>
		<form action='' method='post' class='form'>
			<input id='rID' name='rID' type="hidden" value=<?php echo '"'.$result['rID'].'"'; ?>/>
			
			<input id='rUID' name='rUID' type="hidden" value=<?php echo '"'.$result['rUID'].'"'; ?>/>

			<div class='form-row'>
				<label for='rDComputer'>Computer</label>
				<input id='rDComputer' name='rDComputer' type='text' placeholder='' required value=<?php echo '"'.$result['rDComputer'].'"'; ?>/>
			</div>
			<div class='form-row'>
				<label for='rDeviceName'>Device Name</label>
				<input id='rDeviceName' name='rDeviceName' type='rDeviceName' placeholder='Name of device?' required value=<?php echo '"'.$result['rDeviceName'].'"';?>/>
			</div>
			<div class='form-row'>
				<label for='rMAC'>Devices MAC Adress</label>
				<input id='rMAC' name='rMAC' type='text' placeholder='00:0a:95:9d:68:16' required value=<?php echo '"'.$result['rMAC'].'"';?>/>
			</div>

			<div class='form-row'>
				<label for='dIPID'>Assign IP address</label>
				<div class="select-contain">
					<select id='dIPID' name='dIPID' class="chosen-select" required>
					<?php
						require($databaseConnect);
						$stmt = $db->query("SELECT * FROM ips ORDER BY ipID ASC");
						
						foreach($stmt as $row) {
							$ipID = $row['ipID'];
							$ipStatus = $db->query("SELECT * FROM devices WHERE devices.dIPID = '$ipID'");
							if (!$ipStatus->rowCount()>0) { 
								echo "<option value=".$row['ipID'].">".$row['ipAddress']."</option>";
							}
						}
						?>
					</select>
				</div>
			</div>
			<div class='form-row'>
				<label for='rUID'>Owner Name</label>
				<div class="select-contain">
					<select id='rUID' name='rUID' class="chosen-select" required readonly value=<?php echo '"'.$result['rUID'].'"';?>>
					<?php
						$stmt = $db->query("SELECT * FROM users ORDER BY uID ASC");
						
						foreach($stmt as $row) {
							if($row['uID']==$result['rUID']){
								echo "<option selected value=".$row['uID'].">".$row['uName']."</option>";
							}else{
								echo "<option value=".$row['uID'].">".$row['uName']."</option>";
							}
						}
						?>
					</select>
				</div>
			</div>
			<div class='form-row'>
				<label for='rGateway'>Gateway</label>
				<select id='rGateway' name='rGateway' required>
				<?php
					$stmt = $db->query("SELECT * FROM gateways ORDER BY gID ASC");
					
					foreach($stmt as $row) {
						if($row['gID']==$result['rGateway']){
							echo "<option selected value=".$row['gID'].">".$row['gName']."</option>";
						}else {
							echo "<option value=".$row['gID'].">".$row['gName']."</option>";
						}
					}
					
					$stmt->closeCursor();
					$db=null;
					?>
				</select>
			</div>
			<div class='form-row'>
				<label for='dDescription'>Description</label>
				<textarea id='dDescription' name='dDescription'></textarea>
				<div class='description'>Give a short description of the device</div>
			</div>
			<div class='form-row'>
				<button>Add</button>
			</div>
			<!-- Chosen Depencies -->
			<script src="../docsupport/jquery-3.2.1.min.js" type="text/javascript"></script>
			<script src="../docsupport/chosen.jquery.js" type="text/javascript"></script>
			<script src="../docsupport/prism.js" type="text/javascript" charset="utf-8"></script>
			<script src="../docsupport/init.js" type="text/javascript" charset="utf-8"></script>
		</form>
	</body>
</html>