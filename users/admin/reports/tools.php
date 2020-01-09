<?php   
	require($_SERVER['DOCUMENT_ROOT'].'/IP-Manager/linksandvars.php'); 
	require($statusCheck);
	adminCheck();
	
	if(!empty($_POST)){
		require($databaseConnect);
		header('Location: '.$_POST['action']);

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
			<a href='<?php echo $adminHome?>'><button>Go Back</button></a>
		</div>

		<header class='form-header'>
			<h1>Tools</h1>
			<h2>These are the function available to you</h2>
		</header>
		
		<form action='' method='post' class='form'>
			
			<div class='form-row'>
				<button type="submit" name="action" value="<?php echo $addStudentForm?>">Add Student</button>
			</div>

			<div class='form-row'>
				<button type="submit" name="action" value="<?php echo $addStaffForm?>">Add Staff</button>
			</div>

			<div class='form-row'>
				<button type="submit" name="action" value="<?php echo $addDeviceForm?>">Add Device</button>
			</div>
		</form>
	</body>
</html>