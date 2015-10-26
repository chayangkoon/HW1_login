<?PHP
	session_start();	
	$conn = oci_connect("system", "0871910044", "//localhost/XE");
	if(empty($_SESSION['ID']) || empty($_SESSION['NAME']) || empty($_SESSION['SURNAME'])){
		echo '<script>window.location = "Login.php";</script>';
	}
	if (!$conn) {
		$m = oci_error();
		echo $m['message'], "\n";
		exit;
	} 
?>

Change Password
<hr>

<form action='CPass.php' method='post'>
	Password <br>
	<input name='password' type='password'><br><br>
	New Password<br>
	<input name='newpassword' type='password'><br>
	Confirm Password<br>
	<input name='confpassword' type='password'><br><br>
	<input name='submit' type='submit' value='Confirm'><br><br>
	<li><a href='MemberPage.php'>Back</a></li>
	
</form>

<?PHP
 
	if(isset($_POST['submit'])){
		$new_password = trim($_POST['newpassword']);
		$conf_password = trim($_POST['confpassword']);
		$password = trim($_POST['password']);
		
		// Fetch each row in an associative array
	
		if($new_password == $conf_password && $newpass != NULL && $password == $_SESSION['PASSWORD']){			
			$query = "UPDATE LOGIN SET PASSWORD='$new_password' WHERE USERNAME = '".$_SESSION['USERNAME']."' and password = '$password'";
			$_SESSION['PASSWORD'] = $new_password;
			$parseRequest = oci_parse($conn, $query);
			oci_execute($parseRequest);
		
			echo 'Success';		
		}
		else{
			echo 'Error';
		}
	};
	oci_close($conn);
?>
