<?php   
	require($_SERVER['DOCUMENT_ROOT'].'/IP-Manager/linksandvars.php'); 
	require($statusCheck);
	adminCheck();
	$sortStmt = 'ORDER BY ipAddress ASC';
	$sort = 'ipAddress';
	$order = 'ASC';
	if(!empty($_POST)){
			$sort = $_POST['sort'];
			$order = $_POST['order'];
			if($sort == 'status'){

				$sort = 'status';
				if($order=='ASC'){

					$sortStmt = 'ORDER BY devices.dIPID, ips.ipID is null';
					$order = 'ASC';
				}else{
					$sortStmt = 'ORDER BY devices.dIPID is null, ips.ipID';
					$order = 'DESC';
				}
			}
			else{
				$sort = 'ipAddress';
				if ($order == 'DESC'){
					$sortStmt = "ORDER BY ipAddress DESC";
					$order = 'DESC';
				}else{
					$sortStmt = "ORDER BY ipAddress ASC";
					$order = 'ASC';
				}
			}
		
	}
	?>
<!DOCTYPE html>
<html lang='en'>
	<head>
		<meta charset='UTF-8'/>
		<meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>SOS-HGIC IP Manager</title>
		<?php echo "<link rel='stylesheet' href='".$css."'/>"; ?>
	</head>
	<body>
		<header class="nobutton">
			<nav>
				<ul>
					<li><a href='<?php echo $adminDevices?>'>All Device</a></li>
					<li><a href='<?php echo $adminStudents?>'>Students</a></li>
					<li><a href='<?php echo $adminStaff?>'>Staff</a></li>
					<li><a href='<?php echo $adminAPs?>'>Access Points</a></li>
					<li><a href='<?php echo $adminServers?>'>Servers</a></li>
					<li><a href='<?php echo $adminReq?>'>Requests</a></li>
					<li class = 'selected'>IP List</li>
					<li><a href='<?php echo $adminTools?>'>Tools</a></li>
					<li><a href='<?php echo $adminSearch?>'>Search Database</a></li>
				</ul>
			</nav>
		</header>
		<form class = 'form' action='' method='post'>
			<div class='form-row'>
				<label for='sort'>Sort By</label>
				<select id='sort' name='sort' onchange="this.form.submit();">
					<option <?php if ($sort == 'ipAddress'){echo 'selected';}?> value='ipAddress'>IP Address</option>

					<option <?php if ($sort == 'status'){echo 'selected';}?> value='status'>Status</option>
				</select>

			</div>

			<div class='form-row' >
				<label for='order'></label>
				<select id='order' name='order' onchange="this.form.submit();">
					<option <?php if ($order == 'ASC'){echo 'selected';}?> value='ASC'>Ascending</option>
					<option <?php if ($order == 'DESC'){echo 'selected';}?> value='DESC'>Descending</option>
				</select>
			</div>
		</form>
		
		<table>
			<tr>
				<th>No.</th>
				<th>IP Address</th>
				<th>Status</th>
			</tr>
			<?php
				require($databaseConnect);

				$stmt = $db->query("SELECT * FROM ips LEFT JOIN devices on devices.dIPID = ips.ipID $sortStmt");
				
				$num = 1;
				
				
				foreach($stmt as $row) {
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
				?>
		</table>

	</body>
</html>