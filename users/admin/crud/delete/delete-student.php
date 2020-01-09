<?php   
	require($_SERVER['DOCUMENT_ROOT'].'/IP-Manager/linksandvars.php'); 
	require($statusCheck);
	adminCheck();
	
	if(!empty($_POST)){
		require($databaseConnect);

		$stuUID = $_POST['stuUID'];

		if($_POST['action'] == 'delete'){
			$stmt = "DELETE FROM students WHERE stuUID = '$stuUID'";
			if ($db->query($stmt) == TRUE) {
				$stmt = "DELETE FROM devices WHERE dUID = '$stuUID'";
				if ($db->query($stmt) == TRUE) {
					$stmt = "DELETE FROM users WHERE uID = '$stuUID'";
					if ($db->query($stmt) == TRUE) {
						header('Location: '.$adminStudents);
					}
				}
			} else {
				echo "Error: ".$db."<br>".$stmt->error;
			}
		}else{
			header('Location: '.$adminStudents);
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
			$stuUID = $_GET['id'];
			$stmt = $db->query("SELECT * FROM students JOIN users ON users.uID = students.stuUID JOIN class ON class.cID = students.stuCID WHERE stuUID=".$stuUID);
			$result = $stmt->fetch();
			?>
		<header class='form-header'>
			<h1>Delete Student Form</h1>
			<h2>Are you sure you want to delete this Student?</h2>
			<div class = 'Description'>
				<h3><em>Name: <?php echo $result['uName']?></em></h3>
				<h3><em>Class: <?php echo $result['cName']?></em></h3>
			</div>

		</header>
		
		<form action='' method='post' class='form'>
			<input id='stuUID' name='stuUID' type="hidden" value=<?php echo '"'.$stuUID.'"'; ?>/>
			

			<div class='form-row'>
				<button type="submit" name="action" value="delete">Delete Student</button>
			</div>

			<div class='form-row'>
				<button type="submit" name="action" value="cancel">Cancel</button>
			</div>
		</form>
	</body>
</html>