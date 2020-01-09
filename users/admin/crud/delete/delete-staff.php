<?php   
	require($_SERVER['DOCUMENT_ROOT'].'/IP-Manager/linksandvars.php'); 
	require($statusCheck);
	adminCheck();
	
	if(!empty($_POST)){
		require($databaseConnect);

		$staUID = $_POST['staUID'];

		if($_POST['action'] == 'delete'){
			$stmt = "DELETE FROM staff WHERE staUID = '$staUID'";
			if ($db->query($stmt) == TRUE) {
				$stmt = "DELETE FROM devices WHERE dUID = '$staUID'";
				if ($db->query($stmt) == TRUE) {
					$stmt = "DELETE FROM users WHERE uID = '$staUID'";
					if ($db->query($stmt) == TRUE) {
						header('Location: '.$adminStaff);
					}
				}
			} else {
				echo "Error: ".$db."<br>".$stmt->error;
			}
		}else{
			header('Location: '.$adminStaff);
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
			<a href='<?php echo $adminStaff?>'><button>Go Back</button></a>
		</div>
		<?php
			require($databaseConnect);
			$staUID = $_GET['id'];
			$stmt = $db->query("SELECT * FROM staff JOIN users ON users.uID = staff.staUID JOIN departments ON departments.depID = staff.staDepID WHERE staUID=".$staUID);
			$result = $stmt->fetch();
			?>
		<header class='form-header'>
			<h1>Delete Staff Form</h1>
			<h2>Are you sure you want to delete this Staff?</h2>
			<div class = 'Description'>
				<h3><em>Name: <?php echo $result['uName']?></em></h3>
				<h3><em>Department: <?php echo $result['depName']?></em></h3>
			</div>

		</header>
		
		<form action='' method='post' class='form'>
			<input id='staUID' name='staUID' type="hidden" value=<?php echo '"'.$staUID.'"'; ?>/>
			

			<div class='form-row'>
				<button type="submit" name="action" value="delete">Delete Staff</button>
			</div>

			<div class='form-row'>
				<button type="submit" name="action" value="cancel">Cancel</button>
			</div>
		</form>
	</body>
</html>