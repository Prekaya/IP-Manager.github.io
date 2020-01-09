<?php   
	require($_SERVER['DOCUMENT_ROOT'].'/IP-Manager/linksandvars.php'); 
	require($statusCheck);
	adminCheck();
	
	if(!empty($_POST)){
	  require($databaseConnect);
	
	  $stuUID = $_POST['stuUID'];
	  $uName = strtolower($_POST['uName']);
	  $uUsername = strtolower($_POST['uUsername']);
	
	  $stuHID = $_POST['stuHID'];
	  $stuCID = $_POST['stuCID'];
	
	$stmt = "UPDATE users SET uName = '$uName', uUsername = '$uUsername'WHERE uID = '$stuUID'";
	
	  
	
	
	  if ($db->query($stmt) == TRUE) {
	    $stmt = "UPDATE students SET stuHID = '$stuHID', stuCID = '$stuCID'  WHERE stuUID = '$stuUID'";
	    $db->query($stmt);
	    $db=null;
	    header('Location: '.$adminStudents);
	  } else {
	    echo "Error: ".$db."<br>".$stmt->error;
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
			<a href='<?php echo $adminStudents?>'><button>Go Back</button></a>
		</div>
		<header class='form-header'>
			<h1>Student Form</h1>
			<p><em>Edit students in the database using this form.</em></p>
		</header>
		<?php
			require($databaseConnect);
			$stuUID = $_GET['id'];
			$stmt = $db->query("SELECT * FROM students  JOIN users ON users.uID=students.stuUID JOIN hostels ON students.stuHID=hostels.hID JOIN class ON students.stuCID=class.cID WHERE stuUID= '$stuUID' ");
			$result = $stmt->fetch();
			?>
		<form action='' method='post' class='form'>
			<input id='stuUID' name='stuUID' type="hidden" value=<?php echo '"'.$stuUID.'"'; ?>/>
			<div class='form-row'>
				<label for='uName'>Name</label>
				<input id='uName' name='uName' type='text' placeholder='Kwesi Manu' maxlength="45" required value=<?php echo '"'.$result['uName'].'"'; ?>/>
			</div>
			<div class='form-row'>
				<label for='uUsername'>Username</label>
				<input id='uUsername' name='uUsername' type='email' placeholder='Manu_k@soshgic.edu.gh' maxlength="45" required   value=<?php echo '"'.$result['uUsername'].'"'; ?>/>
			</div>
			<div class='form-row'>
				<label for='stuCID'>Class</label>
				<select id='stuCID' name='stuCID' required>
				<?php
					$stmt = $db->query("SELECT * FROM class");
					
					foreach($stmt as $row) {
						if($row['cID']==$result['stuCID']){
							echo "<option value = '".$row['cID']."'selected>".$row['cName']."</option>";
						}
						else{
							echo "<option value = '".$row['cID']."'>".$row['cName']."</option>";
						}
					}
					$stmt->closeCursor();
					?>
				</select>
			</div>
			<div class='form-row'>
				<label for='stuHID'>Hostel</label>
				<div class="select-contain">
					<select id='stuHID' name='stuHID' class="chosen-select" required>
					<?php
						$stmt = $db->query("SELECT * FROM hostels");
						
						foreach($stmt as $row) {
							if($row['hID']==$result['stuHID']){
								echo "<option value = '".$row['hID']."' selected>".$row['hName']."</option>";
							}
							else{
								echo "<option value = '".$row['hID']."''>".$row['hName']."</option>";
							}
						}
						$stmt->closeCursor();
						?>
					</select>
				</div>
			</div>
			<div class='form-row'>
				<button>Submit</button>
			</div>
		</form>
		<!-- Chosen Depencies -->
		<script src="../docsupport/jquery-3.2.1.min.js" type="text/javascript"></script>
		<script src="../docsupport/chosen.jquery.js" type="text/javascript"></script>
		<script src="../docsupport/prism.js" type="text/javascript" charset="utf-8"></script>
		<script src="../docsupport/init.js" type="text/javascript" charset="utf-8"></script>
	</body>
</html>