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
					<li><a href='<?php echo $adminDevices?>'>All Device</a></li>
					<li><a href='<?php echo $adminStudents?>'>Students</a></li>
					<li class = 'selected'>Staff</li>
					<li><a href='<?php echo $adminAPs?>'>Access Points</a></li>
					<li><a href='<?php echo $adminServers?>'>Servers</a></li>
					<li><a href='<?php echo $adminReq?>'>Requests</a></li>
					<li><a href='<?php echo $adminIPs?>'>IP List</a></li>
					<li><a href='<?php echo $adminTools?>'>Tools</a></li>
					<li><a href='<?php echo $adminSearch?>'>Search Database</a></li>
				</ul>
			</nav>
		</header>
		<a href="<?php echo $addStaffForm?>"><button>Add Staff</button></a>

		<form class = 'form' action='' method='post'>
			<div class='form-row'>
				<label for='sort'>Sort By</label>
				<select id='sort' name='sort' onchange="this.form.submit();">
					<option <?php if ($sort == 'uName'){echo 'selected';}?> value="uName">Name</option>
					<option <?php if ($sort == 'depName'){echo 'selected';}?> value="depName">Department</option>
					<option <?php if ($sort == 'uNumDevices'){echo 'selected';}?> value="uNumDevices">No. Devices</option>
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
				<th>Name</th>
				<th>Department</th>
				<th>Num Devices</th>
			</tr>
			<?php
				require($databaseConnect);
				$stmt = $db->query("SELECT * FROM staff  JOIN users ON users.uID=staff.staUID JOIN departments ON staff.staDepID=departments.depID ORDER BY $sort $order");
				
				$num = 1;
				foreach($stmt as $row) {
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
				
				$stmt->closeCursor();
				$db=null;
				?>
		</table>
	</body>
</html>