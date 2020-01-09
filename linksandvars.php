<?php
	$databaseConnect = $_SERVER['DOCUMENT_ROOT'].'/IP-Manager/methods/dbConnect.php';
	$statusCheck = $_SERVER['DOCUMENT_ROOT'].'/IP-Manager/methods/statusCheck.php';
	$loginPage = 'http://localhost/IP-Manager';
	$searchDB = $_SERVER['DOCUMENT_ROOT'].'/IP-Manager/methods/searchDB.php';
	
	//Styling sheets
	$css = 'http://localhost/IP-Manager/css/style.css';
	$formcss = 'http://localhost/IP-Manager/css/formstyle.css';
	$chosen='http://localhost/IP-Manager/css/chosenLibrary/';
	$delFormcss = 'http://localhost/IP-Manager/css/delformstyle.css';
	$searchFormcss = 'http://localhost/IP-Manager/css/searchformstyle.css';
	
	//User pages
	$userHome = 'http://localhost/IP-Manager/users/reg-user/all-devices.php';
	
	//Admin pages
	$adminHome = 'http://localhost/IP-Manager/users/admin/reports/all-devices.php';
	$adminStaff = 'http://localhost/IP-Manager/users/admin/reports/staff.php';
	$adminStudents = 'http://localhost/IP-Manager/users/admin/reports/students.php';
	$adminDevices = 'http://localhost/IP-Manager/users/admin/reports/all-devices.php';
	$adminAPs = 'http://localhost/IP-Manager/users/admin/reports/access-points.php';
	$adminServers = 'http://localhost/IP-Manager/users/admin/reports/servers.php';
	$adminReq = 'http://localhost/IP-Manager/users/admin/reports/requests.php';
	$adminIPs = 'http://localhost/IP-Manager/users/admin/reports/IP-List.php';
	$adminTools = 'http://localhost/IP-Manager/users/admin/reports/tools.php';
	$adminSearch = 'http://localhost/IP-Manager/users/admin/reports/search.php';
	
	//Add forms
	$addDeviceForm = 'http://localhost/IP-Manager/users/admin/crud/add/add-device.php';
	$addStaffForm = 'http://localhost/IP-Manager/users/admin/crud/add/add-staff.php';
	$addStudentForm = 'http://localhost/IP-Manager/users/admin/crud/add/add-student.php';
	$manageReqForm = 'http://localhost/IP-Manager/users/admin/crud/add/manage-request.php';
	
	//Edit forms
	$editStudentForm = 'http://localhost/IP-Manager/users/admin/crud/edit/edit-student.php';
	$editDeviceForm = 'http://localhost/IP-Manager/users/admin/crud/edit/edit-device.php';
	$editStaffForm = 'http://localhost/IP-Manager/users/admin/crud/edit/edit-staff.php';
	
	//Delete forms
	$delStudentForm = 'http://localhost/IP-Manager/users/admin/crud/delete/delete-student.php';
	$delDeviceForm = 'http://localhost/IP-Manager/users/admin/crud/delete/delete-device.php';
	$delStaffForm = 'http://localhost/IP-Manager/users/admin/crud/delete/delete-staff.php';
?>