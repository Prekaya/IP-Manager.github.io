<?php   
	require($_SERVER['DOCUMENT_ROOT'].'/IP-Manager/linksandvars.php'); 
	require($statusCheck);
	adminCheck();
	$sort = 'dComputer';
	$order = 'ASC';
	if(!empty($_POST)){
		if(isset($_POST['sort'])){
			$sort = $_POST['sort'];
		}
		if(isset($_POST['order'])){
			$order = $_POST['order'];
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
					<li class = 'selected'>Servers</li>
					<li><a href='<?php echo $adminReq?>'>Requests</a></li>
					<li><a href='<?php echo $adminIPs?>'>IP List</a></li>
					<li><a href='<?php echo $adminTools?>'>Tools</a></li>
					<li><a href='<?php echo $adminSearch?>'>Search Database</a></li>
				</ul>
			</nav>
		</header>

		<form class = 'form' action='' method='post'>
			<div class='form-row'>
				<label for='sort'>Sort By</label>
				<select id='sort' name='sort' onchange="this.form.submit();">
					<option <?php if ($sort == 'dComputer'){echo 'selected';}?> value="dComputer">Computer</option>
					<option <?php if ($sort == 'dMAC'){echo 'selected';}?> value="dMAC">MAC Address</option>
					<option <?php if ($sort == 'ipAddress'){echo 'selected';}?> value="ipAddress">IP Address</option>
					<option <?php if ($sort == 'dDescription'){echo 'selected';}?> value="dDescription">Description</option>
				</select>

			</div>

			<div class='form-row' >
				<label for='order'></label>
				<select id='order' name='order' onchange="this.form.submit();">
					<option <?php if ($order == 'ASC'){echo 'selected';}?> value="ASC">Ascending</option>
					<option <?php if ($order == 'DESC'){echo 'selected';}?> value="DESC">Descending</option>
				</select>
			</div>
		</form>
		
		<table>
			<tr class="access-points">
				<th>Computer</th>
				<th>MAC Address</th>
				<th>IP address</th>
				<th>Description</th>
			</tr>
			<?php
				require($databaseConnect);
				$stmt = $db->query("SELECT * FROM devices JOIN ips ON devices.dIPID = ips.ipID WHERE dGID = 4");
				
				foreach($stmt as $row) {
					echo "<tr>";
					echo "<td>".$row['dComputer']."</td>";
					echo "<td>".$row['dMAC']."</td>";
					echo "<td>".$row['ipAddress']."</td>";
					echo "<td>".$row['dDescription']."</td>";
					echo "</tr>";
				}
				
				$stmt->closeCursor();
				$db=null;
				?>
		</table>
	</body>
</html>