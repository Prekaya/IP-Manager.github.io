<?php   
	require($_SERVER['DOCUMENT_ROOT'].'/IP-Manager/linksandvars.php'); 
	require($statusCheck);
	adminCheck();
	
	if(!empty($_POST)){
		require($databaseConnect);
	
		$uName = strtolower($_POST['uName']);
		$uUsername = strtolower($_POST['uUsername']);
		$uPassword = password_hash('12345', PASSWORD_DEFAULT);
		$stuCID = $_POST['stuCID'];
		$stuHID = $_POST['stuHID'];
		$stml = "INSERT INTO users (uName, uUsername, uPassword) VALUES ('$uName', '$uUsername', '$uPassword')";
	
		if ($db->query($stml) == TRUE) {
			$id = $db->lastInsertId();
			$stml = "INSERT INTO students (stuUID, stuCID, stuHID) VALUES ('$id', '$stuCID', '$stuHID')";
	
			if ($db->query($stml) == TRUE) {
				$db = null;
				header('Location: '.$adminStudents);
			}
		} else {
			echo "Error: " .$stml."<br>".$db->error;
		}
	}
	?>
<!DOCTYPE html>
<html lang='en'>
	<head>
		<meta charset='UTF-8'/>
		<meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Student Form</title>
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
			<h1>Student Form</h1>
			<p><em>Add students to the database using this form.</em></p>
		</header>
		<form action='' method='post' class='form'>
			<div class='form-row'>
				<label for='uName'>Name</label>
				<input id='uName' name='uName' type='text' placeholder='Kwesi Manu' maxlength="45" required/>
			</div>
			<div class='form-row'>
				<label for='uUsername'>Username</label>
				<input id='uUsername' name='uUsername' type='email' placeholder='Manu_k@soshgic.edu.gh' maxlength="45" required/>
			</div>
			<div class='form-row'>
				<label for='stuCID'>Class</label>
				<select id='stuCID' name='stuCID' required>
				<?php
					require($databaseConnect);
					$stmt = $db->query("SELECT * FROM class ORDER BY cID ASC");
					
					foreach($stmt as $row) {
						echo "<option value=".$row['cID'].">".$row['cName']."</option>";
					}
					?>
				</select>
			</div>
			<div class='form-row'>
				<label for='stuHID'>Hostel</label>
				<div class="select-contain">
					<select id='stuHID' name='stuHID' class="chosen-select" required>
					<?php
						$stmt = $db->query("SELECT * FROM hostels ORDER BY hID ASC");
						
						foreach($stmt as $row) {
							echo "<option value=".$row['hID'].">".$row['hName']."</option>";
						}
						
						$stmt->closeCursor();
						$db=null;
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