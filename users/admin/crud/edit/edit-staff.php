<?php   
	require($_SERVER['DOCUMENT_ROOT'].'/IP-Manager/linksandvars.php'); 
	require($statusCheck);
	adminCheck():
	
	if(!empty($_POST)){
	  require($databaseConnect);
	
	  $staUID = $_POST['staUID'];
	  $uName = strtolower($_POST['uName']);
	  $uUsername = strtolower($_POST['uUsername']);
	  $staDepID = $_POST['staDepID'];
	
	$stmt = "UPDATE users SET uName = '$uName', uUsername = '$uUsername'WHERE uID = '$staUID'";
	
	  
	
	
	  if ($db->query($stmt) == TRUE) {
	    $stmt = "UPDATE staff SET staDepID = '$staDepID' WHERE staUID = '$staUID'";
	    $db->query($stmt);
	    $db=null;
	    header('Location: '.$adminStaff);
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
			<p><em>Edit staff in the database using this form.</em></p>
		</header>
		<?php
			require($databaseConnect);
			
			$staUID = $_GET['id'];
			$stmt = $db->query("SELECT * FROM staff JOIN users ON users.uID=staff.staUID WHERE staUID= '$staUID'");
			$result = $stmt->fetch();
			?>
		<form action='' method='post' class='form'>
			<input id='staUID' name='staUID' type="hidden" value=<?php echo '"'.$staUID.'"'; ?>/>
			<div class='form-row'>
				<label for='uName'>Name</label>
				<input id='uName' name='uName' type='text' placeholder='Kwesi Manu' required  value=<?php echo '"'.$result['uName'].'"'; ?>/>
			</div>
			<div class='form-row'>
				<label for='uUsername'>Username</label>
				<input id='uUsername' name='uUsername' type='email' placeholder='Manu_k@soshgic.edu.gh' maxlength="45" required   value=<?php echo '"'.$result['uUsername'].'"'; ?>/>
			</div>
			<div class='form-row'>
				<label for='staDepID'>Department</label>
				<div class="select-contain">
					<select id='staDepID' name='staDepID' class="chosen-select" required >
					<?php
						require($databaseConnect);
						$stmt = $db->query("SELECT * FROM departments ORDER BY depID ASC");
						
						foreach($stmt as $row) {
						    if($row['depID']==$result['staDepID']){
						    echo "<option selected value=".$row['depID'].">".$row['depName']."</option>";
						  }else {
						    echo "<option value=".$row['depID'].">".$row['depName']."</option>";
						  }
						}
						
						$stmt->closeCursor();
						$db = null;
						?>
					</select>
				</div>
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