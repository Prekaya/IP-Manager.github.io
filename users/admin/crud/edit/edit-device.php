<?php   
	require($_SERVER['DOCUMENT_ROOT'].'/IP-Manager/linksandvars.php'); 
	require($statusCheck);
	adminCheck();
	
	if(!empty($_POST)){
		require($databaseConnect);
	
		$dID = $_POST['dID'];
		$dComputer = strtolower($_POST['dComputer']);
		$dDeviceName = strtolower($_POST['dDeviceName']);
		$dMAC = $_POST['dMAC'];
		$dIPID = $_POST['dIPID'];
		$dUID = $_POST['dUID'];
		$dGID = $_POST['dGID'];
		$dDescription = strtolower($_POST['dDescription']);
	
		$stmt = "UPDATE devices SET dComputer = '$dComputer', dDeviceName = '$dDeviceName', dMAC = '$dMAC', dIPID = '$dIPID', dUID = '$dUID', dDescription = '$dDescription' WHERE dID = '$dID'";
	
	
		if ($db->query($stmt) == TRUE) {
			$db->query($stmt);
			$db=null;
			header('Location: '.$adminDevices);
		} else {
			echo "Error: ".$db."<br>".$stmt->error;
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
			$dID = $_GET['id'];
			$stmt = $db->query("SELECT * FROM devices WHERE dID=".$dID);
			$result = $stmt->fetch();
			?>
		<form action='' method='post' class='form'>
			<input id='dID' name='dID' type="hidden" value=<?php echo '"'.$dID.'"'; ?>/>
			<input id='dUID' name='dUID' type="hidden" value=<?php echo '"'.$result['dUID'].'"'; ?>/>
			<div class='form-row'>
				<label for='dComputer'>Computer</label>
				<input id='dComputer' name='dComputer' type='text' placeholder='' required value=<?php echo '"'.$result['dComputer'].'"'; ?>/>
			</div>
			<div class='form-row'>
				<label for='dDeviceName'>Device Name</label>
				<input id='dDeviceName' name='dDeviceName' type='dDeviceName' placeholder='Name of device?' required value=<?php echo '"'.$result['dDeviceName'].'"';?>/>
			</div>
			<div class='form-row'>
				<label for='dMAC'>Devices MAC Adress</label>
				<input id='dMAC' name='dMAC' type='text' placeholder='00:0a:95:9d:68:16' required value=<?php echo '"'.$result['dMAC'].'"';?>/>
			</div>
			<div class='form-row'>
				<label for='dIPID'>Assign IP address</label>
				<div class="select-contain">
					<select id='dIPID' name='dIPID' class="chosen-select" required value=<?php echo '"'.$result['dIPID'].'"';?>>
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
				<label for='dUID'>Owner Name</label>
				<div class="select-contain">
					<select id='dUID' name='dUID' class="chosen-select" required value=<?php echo '"'.$result['uID'].'"';?>>
					<?php
						$stmt = $db->query("SELECT * FROM users ORDER BY uID ASC");
						
						foreach($stmt as $row) {
							if($row['uID']==$result['uID']){
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
				<label for='dGID'>Gateway</label>
				<select id='dGID' name='dGID' required>
				<?php
					$stmt = $db->query("SELECT * FROM gateways ORDER BY gID ASC");
					
					foreach($stmt as $row) {
						if($row['gID']==$result['gID']){
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
				<textarea id='dDescription' name='dDescription'><?php echo $result['dDescription'];?></textarea>
				<div class='instructions'>Give a short description of the device</div>
			</div>
			<div class='form-row'>
				<button>Update</button>
			</div>
			<!-- Chosen Depencies -->
			<script src="../docsupport/jquery-3.2.1.min.js" type="text/javascript"></script>
			<script src="../docsupport/chosen.jquery.js" type="text/javascript"></script>
			<script src="../docsupport/prism.js" type="text/javascript" charset="utf-8"></script>
			<script src="../docsupport/init.js" type="text/javascript" charset="utf-8"></script>
		</form>
	</body>
</html>