<?php   
	require($_SERVER['DOCUMENT_ROOT'].'/IP-Manager/linksandvars.php');
	require($statusCheck);
	adminCheck();

	require($databaseConnect);
	$sort = 'all';
	$searchTerm = '';
	$produceDevices = FALSE;
	$produceStudents = FALSE;
	$produceStaff = FALSE;
	$produceAPs = FALSE;
	$produceServers = FALSE;
	$produceRequests = FALSE;
	$produceIPs = FALSE;
	$produceAll = FALSE;
	if(!empty($_POST)){
		$sort = $_POST['sort'];
		$searchTerm = $_POST['searchTerm'];
		if ($sort == 'devices'){
			$produceDevices = TRUE;
		} else if ($_POST['sort'] == 'students') {
			$produceStudents = TRUE;
		} else if ($sort == 'staff') {
			$produceStaff = TRUE;
		} else if ($sort == 'accessPoints') {
			$produceAPs = TRUE;
		} else if ($sort == 'servers') {
			$produceServers = TRUE;
		} else if ($sort == 'requests') {
			$produceRequests = TRUE;
		}  else if ($sort == 'ips') {
			$produceIPs = TRUE;
		}  else if ($sort == 'all') {
			$produceAll = TRUE;
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
		<?php echo "<link rel='stylesheet' href='".$searchFormcss."'/>";?>
	</head>
	<body>
		<div class = 'buttoncont'>
			<a href='<?php echo $adminHome?>'><button>Go Back</button></a>
		</div>

		<header class='form-header'>
			<h1>Search</h1>
			<p>1. Type in a term to search</p>
			<p>2. Choose what to search by</p>
			<p>3. Press enter to search the database</p>
		</header>
		
		<form action='' method='post' class='form'>
			<div class='form-row'>
				<label for='searchTerm'>Search Term</label>
				<input id='searchTerm' name='searchTerm' type='text' value=<?php echo '"'.$searchTerm.'"';?>/>
			</div>

			<div class='form-row'>
				<label for='sort'>Sort By</label>
				<select id='sort' name='sort' onchange="this.form.submit();">
					<option <?php if ($sort == 'all'){echo 'selected';}?> value="all">All</option>
					<option <?php if ($sort == 'devices'){echo 'selected';}?> value="devices">Devices</option>
					<option <?php if ($sort == 'students'){echo 'selected';}?> value="students">Students</option>
					<option <?php if ($sort == 'staff'){echo 'selected';}?> value="staff">Staff</option>
					<option <?php if ($sort == 'accessPoints'){echo 'selected';}?> value="accessPoints">Access Points</option>
					<option <?php if ($sort == 'servers'){echo 'selected';}?> value="servers">Servers</option>
					<option <?php if ($sort == 'requests'){echo 'selected';}?> value="requests">Requests</option>
					<option <?php if ($sort == 'ips'){echo 'selected';}?> value="ips">IPs</option>
				</select>

			</div>

		</form>
		<?php
		require($databaseConnect);
		require($searchDB);
		if($produceDevices || $produceAll){
			echo "<table>";
			echo "<tr>";
			echo "<th>No.</th>";
			echo "<th>Owner Name</th>";
			echo "<th>Gateway</th>";
			echo "<th>Computer</th>";
			echo "<th>Device</th>";
			echo "<th>MAC address</th>";
			echo "<th>IP address</th>";
			echo "<th>Description</th>";
			echo "</tr>";
			
			$ResArr = searchDevices($searchTerm);
			$num = 1;

			foreach($ResArr as $row) {
				//$delete = "../crud/deletedevice.php?id=".$row['id'];
				echo "<tr>";
				echo 	"<td>";
				echo 	"<ul class='menu'>";
				echo	"<li class='dropdown'><span>".$num."</span>";
				echo    "<ul class='features-menu'>";          // <!-- Start of submenu -->
				echo    "<li><a href='".$editDeviceForm."?id=".$row['dID']."'>Edit</a></li>";
				echo    "<li><a href='".$delDeviceForm."?id=".$row['dID']."'>Delete</a></li>";
				echo    "</ul>";                              //  <!-- End of submenu -->
				echo    "</li>";
				echo 	"</ul>";
				echo "</td>";
				echo "<td>".$row['uName']."</td>";
				echo "<td>".$row['gName']."</td>";
				echo "<td>".$row['dComputer']."</td>";
				echo "<td>".$row['dDeviceName']."</td>";
				echo "<td>".$row['dMAC']."</td>";
				echo "<td>".$row['ipAddress']."</td>";
				echo "<td>".$row['dDescription']."</td>";

				echo "</tr>";
				$num = $num + 1;
			}
			echo "</table>";
		}

		if($produceStudents || $produceAll) { 
			echo "<table>";
			echo "<tr>";
			echo "<th>No.</th>";
			echo "<th>Name</th>";
			echo "<th>Year</th>";
			echo "<th>Hostel</th>";
			echo "<th>No. Devices</th>";
			echo "</tr>";

			
			$ResArr = searchStudents($searchTerm);
			$num = 1;

			foreach($ResArr as $row) {
				echo "<tr>";
				echo 	"<td>";
				echo 	"<ul class='menu'>";
				echo	"<li class='dropdown'><span>".$num."</span>";
				echo    "<ul class='features-menu'>";          // <!-- Start of submenu -->
				echo    "<li><a href='".$editStudentForm."?id=".$row['stuUID']."'>Edit</a></li>";
				echo    "<li><a href='".$delStudentForm."?id=".$row['stuUID']."'>Delete</a></li>";
				echo    "</ul>";                              //  <!-- End of submenu -->
				echo    "</li>";
				echo 	"</ul>";
				echo "<td>".$row['uName']."</td>";
				echo "<td>".$row['cName']."</td>";
				echo "<td>".$row['hName']."</td>";
				echo "<td>".$row['uNumDevices']."</td>";
				echo "</tr>";
				$num += 1;
			}
			echo "</table>";
		}

		if($produceStaff || $produceAll) { 
			echo "<table>";
			echo "<tr>";
			echo "<th>No.</th>";
			echo "<th>Name</th>";
			echo "<th>Department</th>";
			echo "<th>Num Devices</th>";
			echo "</tr>";

			
			$ResArr = searchStaff($searchTerm);
			$num = 1;

			foreach($ResArr as $row) {
				echo "<tr>";
				echo 	"<td>";
				echo 	"<ul class='menu'>";
				echo	"<li class='dropdown'><span>".$num."</span>";
				echo    "<ul class='features-menu'>";          // <!-- Start of submenu -->
				echo    "<li><a href='".$editStaffForm."?id=".$row['staUID']."'>Edit</a></li>";
				echo    "<li><a href='".$delStaffForm."?id=".$row['staUID']."'>Delete</a></li>";
				echo    "</ul>";                              //  <!-- End of submenu -->
				echo    "</li>";
				echo 	"</ul>";
				echo "<td>".$row['uName']."</td>";
				echo "<td>".$row['depName']."</td>";
				echo "<td>".$row['uNumDevices']."</td>";
				echo "</tr>";
				$num += 1;
			}
			echo "</table>";
		}

		if($produceIPs || $produceAll) {
			
			// IP Address Results
			echo "<table>";
			echo "<tr>";
			echo "<th>No.</th>";
			echo "<th>IP Address</th>";
			echo "<th>Status</th>";
			echo "</tr>";
			$ResArr = searchIPs($searchTerm);
			$num = 1;
				
				foreach($ResArr as $row) {
					$ipID = $row['ipID'];
					$ipStatus = $db->query("SELECT * FROM devices WHERE devices.dIPID = '$ipID'");
					$Active = ($ipStatus->rowCount()>0);
					echo "<tr>";
					echo "<td>".$num."</td>";
					echo "<td>".$row['ipAddress']."</td>";
					if ($Active){
						echo "<td>In Use</td>";
					} else {
						echo "<td>Not Used</td>";
					}
					echo "</tr>";
					$num+=1;
				}

			
			echo "</table>";
			if (empty($ResArr)){
					echo "There are no results for this table";
				}
		}


		?>
	</body>
</html>