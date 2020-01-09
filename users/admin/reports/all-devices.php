<?php   
	require($_SERVER['DOCUMENT_ROOT'].'/IP-Manager/linksandvars.php'); 
	require($statusCheck);
	adminCheck();
	$sort = 'uName';
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
		<title>IP Manager</title>
		<?php echo "<link rel='stylesheet' href='".$css."'/>"; ?>
	</head>
	<body>
		<header>
			<nav>
				<ul>
					<li class='selected'>All Devices</li>
					<li><a href='<?php echo $adminStudents?>'>Students</a></li>
					<li><a href='<?php echo $adminStaff?>'>Staff</a></li>
					<li><a href='<?php echo $adminAPs?>'>Access Points</a></li>
					<li><a href='<?php echo $adminServers?>'>Servers</a></li>
					<li><a href='<?php echo $adminReq?>'>Requests</a></li>
					<li><a href='<?php echo $adminIPs?>'>IP List</a></li>
					<li><a href='<?php echo $adminTools?>'>Tools</a></li>
					<li><a href='<?php echo $adminSearch?>'>Search Database</a></li>
				</ul>
			</nav>
		</header>
		<a href="<?php echo $addDeviceForm?>"><button>Add Device</button></a>
		<form class = 'form' action='' method='post'>
			<div class='form-row'>
				<label for='sort'>Sort By</label>
				<select id='sort' name='sort' onchange="this.form.submit();">
					<option <?php if ($sort == 'uName'){echo 'selected';}?> value="uName">Owner Name</option>
					<option <?php if ($sort == 'gName'){echo 'selected';}?> value="gName">Gateway</option>
					<option <?php if ($sort == 'dComputer'){echo 'selected';}?> value="dComputer">Computer</option>
					<option <?php if ($sort == 'dDeviceName'){echo 'selected';}?> value="dDeviceName">Device</option>
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
			<tr>
				<th>No.</th>
				<th>Owner Name</th>
				<th>Gateway</th>
				<th>Computer</th>
				<th>Device</th>
				<th>MAC address</th>
				<th>IP address</th>
				<th>Description</th>
				
			</tr>
			<?php
				require($databaseConnect);
				$stmt = $db->query("SELECT * FROM devices JOIN users ON devices.dUID = users.uID JOIN gateways ON devices.dGID = gateways.gID JOIN ips ON devices.dIPID = ips.ipID ORDER BY $sort $order");
				
				$num = 1;
				foreach($stmt as $row) {
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
				
				$stmt->closeCursor();
				$db=null;
				?>
		</table>
	</body>
</html>