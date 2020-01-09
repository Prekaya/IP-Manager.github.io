<?php
	require($_SERVER['DOCUMENT_ROOT'].'/IP-Manager/linksandvars.php');
	require($statusCheck);
	userCheck();
	?>
<!DOCTYPE html>
<html lang='en'>
	<head>
		<meta charset='UTF-8'/>
		<meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Device Manager</title>
		<?php echo "<link rel='stylesheet' href='".$css."'/>"; ?>
	</head>
	<body>
		<header>
			<nav>
				<ul>
					<li class = 'selected'>Devices</li>
					<li><a href='requests.php'>View Requests</a></li>
					<li><a href='request-form.php'>Make Request</a></li>
				</ul>
			</nav>
		</header>
		<table>
			<tr>
				<th>No.</th>
				<th>Computer</th>
				<th>Device Name</th>
				<th>MAC address</th>
				<th>Description</th>
			</tr>
			<?php
				require($databaseConnect);
				$uID = $_SESSION['uID'];
				$stmt = $db->query("SELECT * FROM devices WHERE dUID = $uID");
				
				if($stmt->rowCount()>0){
					$num = 1;
					
					foreach($stmt as $row) {
						echo "<tr>";
						echo "<td>".$num."</td>";
						echo "<td>".$row['dComputer']."</td>";
						echo "<td>".$row['dDeviceName']."</td>";
						echo "<td>".$row['dMAC']."</td>";
						echo "<td>".$row['dDescription']."</td>";
						echo "</tr>";
						$num = $num + 1;
					}
				}
				
				$stmt->closeCursor();
				$db=null;
				?>
		</table>
	</body>
</html>