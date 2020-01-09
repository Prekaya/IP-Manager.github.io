<?php   
	require($_SERVER['DOCUMENT_ROOT'].'/IP-Manager/linksandvars.php'); 
	require($statusCheck);
	adminCheck();
	
	if(!empty($_POST)){
		require($databaseConnect);
	
		$uName = strtolower($_POST['uName']);
		$uUsername = $_POST['uUsername'];
		$uPassword = password_hash('12345', PASSWORD_DEFAULT);
		$staDepID =$_POST['staDepID'];
		$stmt = "INSERT INTO users (uName, uUsername, uPassword) VALUES ('$uName', '$uUsername', '$uPassword')";
	
		if ($db->query($stmt) == TRUE) {
			$id = $db->lastInsertId();
			$stmt = "INSERT INTO staff (staUID, staDepID) VALUES ('$id', '$staDepID')";
	
			if ($db->query($stmt) == TRUE) {
				$db = null;
				header('Location: '.$adminStaff);
			}
		}else {
			echo "Error: ".$stmt ."<br>".$db->error;
		}
	}
	?>
<!DOCTYPE html>
<html lang='en'>
	<head>
		<meta charset='UTF-8'/>
		<meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Staff Form</title>
		<?php 
			echo "<link rel='stylesheet' href='".$chosen."chosen.css'/>";
			echo "<link rel='stylesheet' href='".$formcss."'/>";
			?>
	</head>
	<body>
		<div class='buttoncont'>
			<a href='<?php echo $adminHome?>'><button>Go Back</button></a>
		</div>
		<header class='form-header'>
			<h1>Staff Form</h1>
			<p><em>Add staff to the database using this form.</em></p>
		</header>
		<form action='' method='post' class='form'>
			<div class='form-row'>
				<label for='uName'>Name</label>
				<input id='uName' name='uName' type='text' placeholder='Kwesi Manu' required/>
			</div>
			<div class='form-row'>
				<label for='uUsername'>Username</label>
				<input id='uUsername' name='uUsername' type='email' placeholder='Manu_k@soshgic.edu.gh' maxlength="45" required/>
			</div>
			<div class='form-row'>
				<label for='depID'>Department</label>
				<div class="select-contain">
					<select id='staDepID' name='staDepID' class="chosen-select" required>
					<?php
						require($databaseConnect);
						$stmt = $db->query("SELECT * FROM departments ORDER BY depID ASC");
						
						foreach($stmt as $row) {
							echo "<option value=".$row['depID'].">".$row['depName']."</option>";
						}
						$db = null;
						?>
					</select>
				</div>
			</div>
			<div class='form-row'>
				<button>Submit</button>
			</div>
			<!-- Chosen Depencies -->
			<script src="../docsupport/jquery-3.2.1.min.js" type="text/javascript"></script>
			<script src="../docsupport/chosen.jquery.js" type="text/javascript"></script>
			<script src="../docsupport/prism.js" type="text/javascript" charset="utf-8"></script>
			<script src="../docsupport/init.js" type="text/javascript" charset="utf-8"></script>
		</form>
	</body>
</html>