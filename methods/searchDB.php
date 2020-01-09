<?php
	function searchDevices($searchTerm){
		$ResArr = array();
		$IdArr = array();
		require($_SERVER['DOCUMENT_ROOT'].'/IP-Manager/linksandvars.php'); 
		require($databaseConnect);
		$stmt = "SELECT * FROM devices JOIN users ON devices.dUID = users.uID JOIN gateways ON devices.dGID = gateways.gID JOIN ips ON devices.dIPID = ips.ipID";
		$rs = $db->query($stmt);
		$columnNames = array();
		$colCount = $rs->columnCount();
		for($i = 0; $i <$colCount; $i++) {
			$col = $rs->getColumnMeta($i);
			$fieldInfo = $col['name'];
			$columnNames[] = $fieldInfo;
		}
		$num = 1;

		for($i = 0; $i<$colCount; $i++){
			$stmt = "SELECT * FROM devices JOIN users ON devices.dUID = users.uID JOIN gateways ON devices.dGID = gateways.gID JOIN ips ON devices.dIPID = ips.ipID WHERE ".$columnNames[$i]." LIKE '%".$searchTerm."%'";
			$Results = $db->query($stmt);
			foreach ($Results as $row) {
				$id = $row['dID'];
				if(!in_array($id, $IdArr)){
					$IdArr[] = $id;
					$ResArr[] = $row;
				}
			}

		}
		return $ResArr;
	}

	function searchIPs($searchTerm){
		$ResArr = array();
		$IdArr = array();
		require($_SERVER['DOCUMENT_ROOT'].'/IP-Manager/linksandvars.php'); 
		require($databaseConnect);
		$stmt = "SELECT * FROM ips";
		$rs = $db->query($stmt);
		$columnNames = array();
		$colCount = $rs->columnCount();
		for($i = 0; $i <$colCount; $i++) {
			$col = $rs->getColumnMeta($i);
			$fieldInfo = $col['name'];
			$columnNames[] = $fieldInfo;
		}
		$num = 1;

		for($i = 0; $i<$colCount; $i++){
			$stmt = "SELECT * FROM ips WHERE ".$columnNames[$i]." LIKE '%".$searchTerm."%'";
			$Results = $db->query($stmt);
			foreach ($Results as $row) {
				$id = $row['ipID'];
				if(!in_array($id, $IdArr)){
					$IdArr[] = $id;
					$ResArr[] = $row;
				}
			}

		}
		return $ResArr;
	}

	function searchStudents($searchTerm){
		$ResArr = array();
		$IdArr = array();
		require($_SERVER['DOCUMENT_ROOT'].'/IP-Manager/linksandvars.php'); 
		require($databaseConnect);
		$stmt = "SELECT * FROM students  JOIN users ON users.uID=students.stuUID JOIN hostels ON students.stuHID=hostels.hID JOIN class ON students.stuCID=class.cID";
		$rs = $db->query($stmt);
		$columnNames = array();
		$colCount = $rs->columnCount();
		for($i = 0; $i <$colCount; $i++) {
			$col = $rs->getColumnMeta($i);
			$fieldInfo = $col['name'];
			$columnNames[] = $fieldInfo;
		}
		$num = 1;

		for($i = 0; $i<$colCount; $i++){
			$stmt = "SELECT * FROM students  JOIN users ON users.uID=students.stuUID JOIN hostels ON students.stuHID=hostels.hID JOIN class ON students.stuCID=class.cID WHERE ".$columnNames[$i]." LIKE '%".$searchTerm."%'";
			$Results = $db->query($stmt);
			foreach ($Results as $row) {
				$id = $row['stuUID'];
				if(!in_array($id, $IdArr)){
					$IdArr[] = $id;
					$ResArr[] = $row;
				}
			}

		}
		return $ResArr;
	}

	function searchAPs($searchTerm){
		$ResArr = array();
		$IdArr = array();
		require($_SERVER['DOCUMENT_ROOT'].'/IP-Manager/linksandvars.php'); 
		require($databaseConnect);
		$stmt = "SELECT * FROM devices JOIN ips ON devices.dIPID = ips.ipID WHERE dGID = 3";
		$rs = $db->query($stmt);
		$columnNames = array();
		$colCount = $rs->columnCount();
		for($i = 0; $i <$colCount; $i++) {
			$col = $rs->getColumnMeta($i);
			$fieldInfo = $col['name'];
			$columnNames[] = $fieldInfo;
		}
		$num = 1;

		for($i = 0; $i<$colCount; $i++){
			$stmt = "SELECT * FROM devices JOIN ips ON devices.dIPID = ips.ipID WHERE dGID = 3 WHERE ".$columnNames[$i]." LIKE '%".$searchTerm."%'";
			$Results = $db->query($stmt);
			foreach ($Results as $row) {
				$id = $row['dID'];
				if(!in_array($id, $IdArr)){
					$IdArr[] = $id;
					$ResArr[] = $row;
				}
			}

		}
		return $ResArr;
	}

	function searchServers($searchTerm){
		$ResArr = array();
		$IdArr = array();
		require($_SERVER['DOCUMENT_ROOT'].'/IP-Manager/linksandvars.php'); 
		require($databaseConnect);
		$stmt = "SELECT * FROM devices JOIN ips ON devices.dIPID = ips.ipID WHERE dGID = 4";
		$rs = $db->query($stmt);
		$columnNames = array();
		$colCount = $rs->columnCount();
		for($i = 0; $i <$colCount; $i++) {
			$col = $rs->getColumnMeta($i);
			$fieldInfo = $col['name'];
			$columnNames[] = $fieldInfo;
		}
		$num = 1;

		for($i = 0; $i<$colCount; $i++){
			$stmt = "SELECT * FROM devices JOIN ips ON devices.dIPID = ips.ipID WHERE dGID = 4 WHERE ".$columnNames[$i]." LIKE '%".$searchTerm."%'";
			$Results = $db->query($stmt);
			foreach ($Results as $row) {
				$id = $row['dID'];
				if(!in_array($id, $IdArr)){
					$IdArr[] = $id;
					$ResArr[] = $row;
				}
			}

		}
		return $ResArr;
	}

	function searchStaff($searchTerm){
		$ResArr = array();
		$IdArr = array();
		require($_SERVER['DOCUMENT_ROOT'].'/IP-Manager/linksandvars.php'); 
		require($databaseConnect);
		$stmt = "SELECT * FROM staff  JOIN users ON users.uID=staff.staUID JOIN departments ON staff.staDepID=departments.depID";
		$rs = $db->query($stmt);
		$columnNames = array();
		$colCount = $rs->columnCount();
		for($i = 0; $i <$colCount; $i++) {
			$col = $rs->getColumnMeta($i);
			$fieldInfo = $col['name'];
			$columnNames[] = $fieldInfo;
		}
		$num = 1;

		for($i = 0; $i<$colCount; $i++){
			$stmt = "SELECT * FROM staff  JOIN users ON users.uID=staff.staUID JOIN departments ON staff.staDepID=departments.depID WHERE ".$columnNames[$i]." LIKE '%".$searchTerm."%'";
			$Results = $db->query($stmt);
			foreach ($Results as $row) {
				$id = $row['staUID'];
				if(!in_array($id, $IdArr)){
					$IdArr[] = $id;
					$ResArr[] = $row;
				}
			}

		}
		return $ResArr;
	}

	function searchReq($searchTerm){
		$ResArr = array();
		$IdArr = array();
		require($_SERVER['DOCUMENT_ROOT'].'/IP-Manager/linksandvars.php'); 
		require($databaseConnect);
		$stmt = "SELECT * FROM requests  JOIN users ON requests.rUID = users.uID";
		$rs = $db->query($stmt);
		$columnNames = array();
		$colCount = $rs->columnCount();
		for($i = 0; $i <$colCount; $i++) {
			$col = $rs->getColumnMeta($i);
			$fieldInfo = $col['name'];
			$columnNames[] = $fieldInfo;
		}
		$num = 1;

		for($i = 0; $i<$colCount; $i++){
			$stmt = "SELECT * FROM requests  JOIN users ON requests.rUID = users.uID WHERE ".$columnNames[$i]." LIKE '%".$searchTerm."%'";
			$Results = $db->query($stmt);
			foreach ($Results as $row) {
				$id = $row['rID'];
				if(!in_array($id, $IdArr)){
					$IdArr[] = $id;
					$ResArr[] = $row;
				}
			}

		}
		return $ResArr;
	}
	?>